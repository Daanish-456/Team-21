<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private function addressValidationRules(): array
    {
        return [
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'county' => 'nullable|string|max:120',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:120',
        ];
    }

    private function profileValidationRules(?int $ignoreUserId = null): array
    {
        $emailRule = 'required|email|unique:Users,Email';

        if ($ignoreUserId !== null) {
            $emailRule .= ',' . $ignoreUserId . ',UserID';
        }

        return [
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'phone' => 'nullable|string|max:30',
        ];
    }

    private function formatAddress(array $validated): string
    {
        return rtrim(implode("\n", [
            $validated['address_line_1'],
            $validated['address_line_2'] ?? '',
            $validated['city'],
            $validated['county'] ?? '',
            strtoupper($validated['postcode']),
            $validated['country'],
        ]), "\n");
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => $this->profileValidationRules()['email'],
            'name' => $this->profileValidationRules()['name'],
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'name.required' => 'Name is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'confirm_password.required' => 'Please confirm your password.',
            'confirm_password.same' => 'Passwords do not match.',
        ]);

        $password_hash = password_hash($credentials['password'], PASSWORD_BCRYPT);

        $user = User::create([
            'Email' => $credentials['email'],
            'Name' => $credentials['name'],
            'Password' => $password_hash,
        ]);
        $user->save();

        $request->session()->regenerate();
        $request->session()->put('UserID', $user->UserID);
        $request->session()->put('UserName', $user->Name);

        return redirect('/account');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $credentials['email'])->first();
        if ($user) {
            if (password_verify($credentials['password'], $user->Password)) {
                $request->session()->regenerate();
                $request->session()->put('UserID', $user->UserID);
                $request->session()->put('UserName', $user->Name);

                return redirect('/account');
            }
        }

        return back()->with('error', 'The credentials provided are not correct!');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return redirect('/');
    }

    public function saveCheckoutAddress(Request $request)
    {
        $validated = $request->validate($this->addressValidationRules());

        $user = User::where('UserID', session('UserID'))->firstOrFail();
        $user->Address = $this->formatAddress($validated);
        $user->save();

        return redirect()->route('checkout')->with('success', 'Address saved to your account.');
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('UserID', session('UserID'))->firstOrFail();

        $validated = $request->validateWithBag('profile', $this->profileValidationRules($user->UserID), [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.max' => 'Phone number must be 30 characters or fewer.',
        ]);

        $user->Name = $validated['name'];
        $user->Email = $validated['email'];
        $user->Phone = $validated['phone'] ?? null;
        $user->save();

        $request->session()->put('UserName', $user->Name);

        return redirect()->route('account')->with('profile_success', 'Account details updated.');
    }

    public function updateAddress(Request $request)
    {
        $user = User::where('UserID', session('UserID'))->firstOrFail();

        $validated = $request->validateWithBag('address', $this->addressValidationRules(), [
            'address_line_1.required' => 'Address line 1 is required.',
            'city.required' => 'Town or city is required.',
            'postcode.required' => 'Postcode is required.',
            'country.required' => 'Country is required.',
        ]);

        $user->Address = $this->formatAddress($validated);
        $user->save();

        return redirect()->route('account')->with('address_success', 'Address updated.');
    }
}

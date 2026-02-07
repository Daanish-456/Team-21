<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|unique:Users,Email',
            'name' => 'required',
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
}

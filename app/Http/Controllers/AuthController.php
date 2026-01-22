<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:User,Email,NULL,UserID',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'Name'     => $request->name,
            'Email'    => $request->email,
            'Password' => Hash::make($request->password),
            'Role'     => 'Customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account');
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'Email'    => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('account');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function account()
    {
        return view('pages.auth.account');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

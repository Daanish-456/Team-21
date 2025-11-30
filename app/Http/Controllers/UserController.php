<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $password_hash = password_hash($credentials['password'], PASSWORD_BCRYPT);

        $user = User::create([
            'Email' => $credentials['email'],
            'Name' => $credentials['name'],
            'Password' => $password_hash
        ]);
        $user->save();

        return redirect('/account');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $credentials['email'])->first();
        if($user) {
            if(password_verify($credentials['password'], $user->Password)) {
                $request->session()->regenerate();
                $request->session()->put('UserID', $user->UserID);
                $request->session()->put('UserName', $user->Name);

                return redirect('/account');
            }
        }
        return back()->with('error', 'The credentials provided are not correct!');
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        return redirect('/');
    }
}

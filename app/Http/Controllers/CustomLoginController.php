<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->admin_id != $user->user_id) {
                return view('layouts.app');
            } else {
                return view('layouts.adminapp');
            }
        }

        return redirect()->route('login')->withErrors(['login' => 'Invalid login credentials']);
    }
}

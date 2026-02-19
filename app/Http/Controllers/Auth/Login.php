<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //Validates input
        $credentials = $request->validate([
            'email' => ['required|email'],
            'password' => ['required'],
        ]);

        //Attempts to log in the user
        if (Auth::attempt($credentials, $request->boolean('remember'))){
            //Regenerates the session for security
            $request->session()->regenerate();

            //redirects to the intended page or home if none
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        //If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}

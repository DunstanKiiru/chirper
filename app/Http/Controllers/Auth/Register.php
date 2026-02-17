<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //validate input

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8|confirmed',
        ]);

        //create user
        $user = User::create([
            'name'=> $validated['name'],
            'email'=> $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        //Log in the user
        Auth::login($user);

        //redirect to home
        return redirect('/')->with('success','Welcome to Chirper!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(64), // Generate verification token
        ]);

        // Send verification email
        Mail::to($user->email)->send(new EmailVerificationRequest($user));

        return redirect('/login')->with('success', 'Account successfully registered. Please check your email for verification.');
    }
}
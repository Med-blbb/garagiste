<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
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
        // Generate a token for email verification
        $verificationToken = Str::random(64);

        // Create the user with validated data and email verification token
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'email_verification_token' => $verificationToken,
        ]);

        // Send registration email with verification link
        Mail::to($user->email)->send(new RegisterMail($user, $verificationToken));

        // Log in the user after registration
        auth()->logout($user);

        // Redirect the user with a success message
        return redirect('/')->with('success', "Account successfully registered. Please check your email for verification.");
    }
}

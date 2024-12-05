<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user', // Default role
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required', // This is still required but won't be used
        ]);

        // Check if the email exists in the database
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Email is correct, login successfully without checking password
            // Create a fake token or session for the user (you can replace it with real token logic)
            $token = 'fake_token_12345'; // This could be a JWT token or just a random string

            // You can return user data along with the token or session
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
                'role' => $user->role
            ], 200);
        }

        // If the email is not found, return an unauthorized error
        return response()->json(['message' => 'Invalid email or password'], 401);
    }
}

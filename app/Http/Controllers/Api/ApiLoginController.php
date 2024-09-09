<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Login Berhasil',
                'user' => $user,
            ], 200);
        }

        // If authentication fails
        return response()->json([
            'status' => 400,
            'success' => false,
            'message' => 'Username atau Password anda salah',
        ], 400);
    }
}

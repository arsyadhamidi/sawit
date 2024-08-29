<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba autentikasi pengguna menggunakan username dan password
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Jika autentikasi berhasil, dapatkan data user
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user,
            ], 200);
        }

        // Jika autentikasi gagal
        return response()->json([
            'success' => false,
            'message' => 'Invalid username or password',
        ], 401);
    }
}

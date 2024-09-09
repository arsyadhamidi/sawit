<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiRegistrasiController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'telp' => 'required|string|min:10|max:15',
            'alamat_domisili' => 'required|string',
            'alamat_kebun' => 'required|string',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah tersedia',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'telp.required' => 'Telepon wajib diisi',
            'telp.min' => 'Telepon minimal 10 karakter',
            'telp.max' => 'Telepon maksimal 15 karakter',
            'alamat_domisili.required' => 'Alamat Domisili wajib diisi',
            'alamat_kebun.required' => 'Alamat Kebun wajib diisi',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level_id' => '2',
            'telp' => $request->telp,
        ]);

        // Menambahkan data ke tabel Petani
        Petani::create([
            'users_id' => $user->id,
            'nama' => $request->name ?? '-',
            'telp' => $request->telp ?? '-',
            'alamat_domisili' => $request->alamat_domisili ?? '-',
            'alamat_kebun' => $request->alamat_kebun ?? '-',
        ]);

        // Mengembalikan response sukses
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

}

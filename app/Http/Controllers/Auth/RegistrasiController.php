<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('auth.registrasi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'telp' => 'required|min:10|max:15',
            'alamat_domisili' => 'required',
            'alamat_kebun' => 'required',
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

        $users = User::create([
            'name' => $request->name ?? '-',
            'username' => $request->username ?? '-',
            'password' => bcrypt($request->password),
            'level_id' => '2',
            'telp' => $request->telp ?? '-',
        ]);

        Petani::create([
            'users_id' => $users->id,
            'nama' => $request->name ?? '-',
            'telp' => $request->telp ?? '-',
            'alamat_domisili' => $request->alamat_domisili ?? '-',
            'alamat_kebun' => $request->alamat_kebun ?? '-',
        ]);

        return redirect('/login')->with('success', 'Selamat ! Anda berhasil melakukan registrasi!');
    }
}

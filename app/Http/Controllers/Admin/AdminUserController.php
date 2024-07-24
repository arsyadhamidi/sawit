<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $levels = Level::latest()->get();
        return view('admin.users.create', [
            'levels' => $levels,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'level_id' => 'required',
            'telp' => 'required|min:10|max:15',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah tersedia',
            'level_id.required' => 'Status Autentikasi wajib diisi',
            'telp.required' => 'Nomor Telepon wajib diisi',
            'telp.min' => 'Nomor Telepon minimal 10 karakter',
            'telp.max' => 'Nomor Telepon maksimal 15 karakter',
        ]);

        $validated['password'] = bcrypt('12345678');

        User::create($validated);

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $users = User::find($id);
        $levels = Level::latest()->get();
        return view('admin.users.edit', [
            'levels' => $levels,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'level_id' => 'required',
            'telp' => 'required|min:10|max:15',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'level_id.required' => 'Status Autentikasi wajib diisi',
            'telp.required' => 'Nomor Telepon wajib diisi',
            'telp.min' => 'Nomor Telepon minimal 10 karakter',
            'telp.max' => 'Nomor Telepon maksimal 15 karakter',
        ]);

        $validated['password'] = bcrypt('12345678');

        User::where('id', $id)->update($validated);

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $users = User::where('id', $id)->first();
        $users->delete();

        return redirect()->route('data-user.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

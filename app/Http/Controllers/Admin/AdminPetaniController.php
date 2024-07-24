<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPetaniController extends Controller
{
    public function index()
    {
        $petanis = Petani::latest()->get();
        return view('admin.petani.index', [
            'petanis' => $petanis,
        ]);
    }

    public function create()
    {
        $users = User::latest()->get();
        return view('admin.petani.create', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required',
            'nama' => 'required',
            'telp' => 'required|min:10|max:15',
            'alamat_domisili' => 'required',
            'alamat_kebun' => 'required',
        ], [
            'users_id.required' => 'Users Id wajib diisi',
            'nama.required' => 'Nama Lengkap wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'telp.min' => 'Telepon minimal 10 karakter',
            'telp.max' => 'Telepon maksimal 15 karakter',
            'alamat_domisili.required' => 'Alamat Domisili wajib diisi',
            'alamat_kebun.required' => 'Alamat Kebun wajib diisi',
        ]);

        Petani::create($validated);

        return redirect()->route('data-petani.index')->with('success', 'Selamat ! Anda berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $users = User::latest()->get();
        $petanis = Petani::where('id', $id)->first();
        return view('admin.petani.edit', [
            'users' => $users,
            'petanis' => $petanis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'users_id' => 'required',
            'nama' => 'required',
            'telp' => 'required|min:10|max:15',
            'alamat_domisili' => 'required',
            'alamat_kebun' => 'required',
        ], [
            'users_id.required' => 'Users Id wajib diisi',
            'nama.required' => 'Nama Lengkap wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'telp.min' => 'Telepon minimal 10 karakter',
            'telp.max' => 'Telepon maksimal 15 karakter',
            'alamat_domisili.required' => 'Alamat Domisili wajib diisi',
            'alamat_kebun.required' => 'Alamat Kebun wajib diisi',
        ]);

        Petani::where('id', $id)->update($validated);

        return redirect()->route('data-petani.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data!');
    }

    public function destroy($id)
    {

        $petanis = Petani::where('id', $id)->first();
        $petanis->delete();

        return redirect()->route('data-petani.index')->with('success', 'Selamat ! Anda berhasil menghapus data!');
    }
}

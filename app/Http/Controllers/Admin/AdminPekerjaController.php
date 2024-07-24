<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Pekerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPekerjaController extends Controller
{
    public function index()
    {
        $pekerjas = Pekerja::latest()->get();
        return view('admin.pekerja.index', [
            'pekerjas' => $pekerjas,
        ]);
    }

    public function create()
    {
        $levels = Level::latest()->get();
        return view('admin.pekerja.create', [
            'levels' => $levels,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level_id' => 'required',
            'nik' => 'required|unique:pekerjas,nik',
            'nama' => 'required',
            'telp' => 'required',
            'sim' => 'required',
            'alamat' => 'required',
            'foto_pekerja' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], [
            'level_id.required' => 'ID Status wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah tersedia',
            'nama.required' => 'Nama Lengkap wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'sim.required' => 'SIM wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'foto_pekerja.required' => 'Foto Pekerja wajib diisi',
            'foto_pekerja.mimes' => 'Foto Pekerja harus memiliki format PNG, JPG, atau JPEG',
            'foto_pekerja.max' => 'Foto Pekerja maksimal 2 MB',
        ]);

        if ($request->file('foto_pekerja')) {
            $validated['foto_pekerja'] = $request->file('foto_pekerja')->store('foto_pekerja');
        }

        $users = User::where('username', $request->nik)->first();
        if (!empty($users)) {
            return back()->with('error', 'Akun anda sudah tersedia');
        }

        $pekerjas = Pekerja::create($validated);

        User::create([
            'name' => $request->nama,
            'username' => $request->nik,
            'password' => bcrypt('12345678'),
            'level_id' => $request->level_id,
            'telp' => $request->telp,
            'pekerja_id' => $pekerjas->id,
        ]);

        return redirect()->route('data-pekerja.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $pekerjas = Pekerja::find($id);
        $levels = Level::latest()->get();
        return view('admin.pekerja.edit', [
            'pekerjas' => $pekerjas,
            'levels' => $levels,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'level_id' => 'required',
            'nama' => 'required',
            'telp' => 'required',
            'sim' => 'required',
            'alamat' => 'required',
        ], [
            'level_id.required' => 'ID Status wajib diisi',
            'nama.required' => 'Nama Lengkap wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'sim.required' => 'SIM wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        $pekerjas = Pekerja::where('id', $id)->first();

        if ($request->file('foto_pekerja')) {
            if ($pekerjas->foto_pekerja) {
                Storage::delete($pekerjas->foto_pekerja);
            }
            $validated['foto_pekerja'] = $request->file('foto_pekerja')->store('foto_pekerja');
        } else {
            $validated['foto_pekerja'] = $pekerjas->foto_pekerja;
        }

        $pekerjas->update($validated);

        return redirect()->route('data-pekerja.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $users = User::where('pekerja_id', $id)->first();
        $users->delete();
        $pekerjas = Pekerja::where('id', $id)->first();
        if ($pekerjas->foto_pekerja) {
            Storage::delete($pekerjas->foto_pekerja);
        }
        $pekerjas->delete();

        return redirect()->route('data-pekerja.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

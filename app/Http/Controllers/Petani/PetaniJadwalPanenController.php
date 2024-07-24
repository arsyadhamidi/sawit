<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\JadwalPanen;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetaniJadwalPanenController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $petanis = Petani::where('users_id', $users->id)->first();
        $jadwals = JadwalPanen::where('petani_id', $petanis->id)->latest()->get();
        return view('petani.jadwal-panen.index', [
            'jadwals' => $jadwals,
        ]);
    }

    public function create()
    {
        return view('petani.jadwal-panen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'waktu_panen.required' => 'Waktu Panen wajib diisi',
            'luas_kebun.required' => 'Luas Kebun wajib diisi',
            'lokasi_kebun.required' => 'Lokasi Kebun wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        $users = Auth::user();
        $petanis = Petani::where('users_id', $users->id)->first();

        $validated['petani_id'] = $petanis->id;

        JadwalPanen::create($validated);

        return redirect()->route('petani-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function show($id)
    {
        $jadwals = JadwalPanen::find($id);
        return view('petani.jadwal-panen.show', [
            'jadwals' => $jadwals,
        ]);
    }

    public function edit($id)
    {
        $jadwals = JadwalPanen::find($id);
        return view('petani.jadwal-panen.edit', [
            'jadwals' => $jadwals,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'waktu_panen.required' => 'Waktu Panen wajib diisi',
            'luas_kebun.required' => 'Luas Kebun wajib diisi',
            'lokasi_kebun.required' => 'Lokasi Kebun wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        JadwalPanen::where('id', $id)->update($validated);

        return redirect()->route('petani-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $jadwals = JadwalPanen::where('id', $id)->first();
        $jadwals->delete();

        return redirect()->route('petani-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

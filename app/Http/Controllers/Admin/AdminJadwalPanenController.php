<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPanen;
use App\Models\Petani;
use Illuminate\Http\Request;

class AdminJadwalPanenController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPanen::latest()->get();
        return view('admin.jadwal-panen.index', [
            'jadwals' => $jadwals,
        ]);
    }

    public function create()
    {
        $petanis = Petani::latest()->get();
        return view('admin.jadwal-panen.create', [
            'petanis' => $petanis
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'petani_id' => 'required',
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'petani_id.required' => 'Petani wajib diisi',
            'waktu_panen.required' => 'Waktu Panen wajib diisi',
            'luas_kebun.required' => 'Luas Kebun wajib diisi',
            'lokasi_kebun.required' => 'Lokasi Kebun wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        JadwalPanen::create($validated);

        return redirect()->route('data-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function show($id)
    {
        $jadwals = JadwalPanen::find($id);
        return view('admin.jadwal-panen.show', [
            'jadwals' => $jadwals,
        ]);
    }

    public function edit($id)
    {
        $jadwals = JadwalPanen::find($id);
        $petanis = Petani::latest()->get();
        return view('admin.jadwal-panen.edit', [
            'jadwals' => $jadwals,
            'petanis' => $petanis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'petani_id' => 'required',
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'petani_id.required' => 'Petani wajib diisi',
            'waktu_panen.required' => 'Waktu Panen wajib diisi',
            'luas_kebun.required' => 'Luas Kebun wajib diisi',
            'lokasi_kebun.required' => 'Lokasi Kebun wajib diisi',
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
        ]);

        JadwalPanen::where('id', $id)->update($validated);

        return redirect()->route('data-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $jadwals = JadwalPanen::where('id', $id)->first();
        $jadwals->delete();

        return redirect()->route('data-jadwalpanen.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

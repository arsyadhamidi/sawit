<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalPanen;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiJadwalPanenController extends Controller
{
    public function index($id)
    {
        $users = User::where('id', $id)->first();
        $petanis = Petani::where('users_id', $users->id)->first();
        $jadwals = JadwalPanen::with('petani')->where('petani_id', $petanis->id)->latest()->get();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $jadwals,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Periksa apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Ambil ID pengguna dari request
        $userId = $request->input('users_id');

        // Temukan petani berdasarkan users_id
        $petani = Petani::where('users_id', $userId)->first();

        // Periksa apakah petani ditemukan
        if (!$petani) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Petani tidak ditemukan',
            ], 404);
        }

        // Buat jadwal panen
        $jadwal = JadwalPanen::create([
            'petani_id' => $petani->id,
            'waktu_panen' => $request->input('waktu_panen'),
            'luas_kebun' => $request->input('luas_kebun'),
            'lokasi_kebun' => $request->input('lokasi_kebun'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Kembalikan response sukses
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $jadwal,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'waktu_panen' => 'required',
            'luas_kebun' => 'required',
            'lokasi_kebun' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Periksa apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Ambil ID pengguna dari request
        $userId = $request->input('users_id');

        // Temukan petani berdasarkan users_id
        $petani = Petani::where('users_id', $userId)->first();

        // Periksa apakah petani ditemukan
        if (!$petani) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Petani tidak ditemukan',
            ], 404);
        }

        // Buat jadwal panen
        $jadwal = JadwalPanen::where('id', $id)->update([
            'petani_id' => $petani->id,
            'waktu_panen' => $request->input('waktu_panen'),
            'luas_kebun' => $request->input('luas_kebun'),
            'lokasi_kebun' => $request->input('lokasi_kebun'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Kembalikan response sukses
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy($id)
    {
        $jadwals = JadwalPanen::where('id', $id)->first();
        $jadwals->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Anda berhasil menghapus jadwal panen ',
        ]);
    }
}

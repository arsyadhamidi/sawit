<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPetaniPageController extends Controller
{
    public function index($id)
    {
        $petanis = Petani::with('users')->where('users_id', $id)->first();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $petanis,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'alamat_domisili' => 'required|string|max:255',
            'alamat_kebun' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kirimkan respons kesalahan
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Cari petani berdasarkan ID
        $petani = Petani::find($id);

        // Jika petani tidak ditemukan, kirimkan respons kesalahan
        if (!$petani) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Petani not found',
            ], 400);
        }

        // Perbarui data petani
        $petani->nama = $request->input('nama');
        $petani->telp = $request->input('telp');
        $petani->alamat_domisili = $request->input('alamat_domisili');
        $petani->alamat_kebun = $request->input('alamat_kebun');
        $petani->save();

        // Kirimkan respons sukses
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Petani updated successfully',
            'data' => $petani,
        ], 200);
    }
}

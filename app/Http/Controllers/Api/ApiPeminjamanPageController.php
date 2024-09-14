<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPeminjamanPageController extends Controller
{
    public function index($id)
    {
        $users = User::where('id', $id)->first();
        $peminjamans = Peminjaman::with('users')->where('users_id', $users->id)->latest()->get();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $peminjamans,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'nominal' => 'required',
            'alasan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $nomor = mt_rand(1000000, 9999999);

        Peminjaman::create([
            'users_id' => $request->users_id,
            'nomor_peminjaman' => $nomor,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'nominal' => $request->nominal,
            'alasan' => $request->alasan,
            'status' => 'Proses',
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Anda berhasil menambahkan data',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'nominal' => 'required',
            'alasan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $peminjamans = Peminjaman::where('id', $id)->first();

        $peminjamans->update([
            'users_id' => $request->users_id,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'nominal' => $request->nominal,
            'alasan' => $request->alasan,
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Anda berhasil memperbaharui data',
        ]);
    }

    public function destroy($id)
    {
        $peminjamans = Peminjaman::where('id', $id)->first();
        if (empty($peminjamans)) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'Data Peminjaman tidak ditemukan',
            ], 400);
        }
        $peminjamans->delete();
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Anda berhasil menghapus data',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetaniPeminjamanController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $peminjamans = Peminjaman::where('users_id', $users->id)->latest()->get();
        return view('petani.peminjaman.index', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function create()
    {
        return view('petani.peminjaman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'nominal' => 'required',
            'alasan' => 'required',
        ], [
            'tgl_awal.required' => 'Tanggal Awal Pembayaran wajib diisi',
            'tgl_akhir.required' => 'Tanggal Akhir Pembayaran wajib diisi',
            'nominal.required' => 'Nominal Pembayaran wajib diisi',
            'alasan.required' => 'Alasan Pembayaran wajib diisi',
        ]);

        $validated['users_id'] = Auth::user()->id;
        $validated['nomor_peminjaman'] = mt_rand(1000000, 9999999);
        $validated['status'] = 'Proses';

        Peminjaman::create($validated);

        return redirect()->route('petani-peminjaman.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $peminjamans = Peminjaman::find($id);
        return view('petani.peminjaman.edit', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'nominal' => 'required',
            'alasan' => 'required',
        ], [
            'tgl_awal.required' => 'Tanggal Awal Pembayaran wajib diisi',
            'tgl_akhir.required' => 'Tanggal Akhir Pembayaran wajib diisi',
            'nominal.required' => 'Nominal Pembayaran wajib diisi',
            'alasan.required' => 'Alasan Pembayaran wajib diisi',
        ]);

        $validated['status'] = 'Proses';

        Peminjaman::where('id', $id)->update($validated);

        return redirect()->route('petani-peminjaman.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $peminjamans = Peminjaman::where('id', $id)->first();
        $peminjamans->delete();

        return redirect()->route('petani-peminjaman.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

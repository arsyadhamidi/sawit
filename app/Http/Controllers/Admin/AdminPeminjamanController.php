<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::latest()->get();
        return view('admin.peminjaman.index', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function create()
    {
        $users = User::whereIn('level_id', ['2', '3', '4'])->latest()->get();
        return view('admin.peminjaman.create', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'nominal' => 'required',
            'alasan' => 'required',
        ], [
            'users_id.required' => 'Pekerja wajib diisi',
            'tgl_awal.required' => 'Tanggal Awal Pembayaran wajib diisi',
            'tgl_akhir.required' => 'Tanggal Akhir Pembayaran wajib diisi',
            'nominal.required' => 'Nominal Pembayaran wajib diisi',
            'alasan.required' => 'Alasan Pembayaran wajib diisi',
        ]);

        $validated['nomor_peminjaman'] = mt_rand(1000000, 9999999);
        $validated['status'] = 'Proses';

        Peminjaman::create($validated);

        return redirect()->route('data-peminjaman.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $peminjamans = Peminjaman::find($id);
        $users = User::whereIn('level_id', ['2', '3', '4'])->latest()->get();
        return view('admin.peminjaman.edit', [
            'users' => $users,
            'peminjamans' => $peminjamans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'users_id' => 'required',
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
            'nominal' => 'required',
            'alasan' => 'required',
            'status' => 'required',
        ], [
            'users_id.required' => 'Pekerja wajib diisi',
            'tgl_awal.required' => 'Tanggal Awal Pembayaran wajib diisi',
            'tgl_akhir.required' => 'Tanggal Akhir Pembayaran wajib diisi',
            'nominal.required' => 'Nominal Pembayaran wajib diisi',
            'alasan.required' => 'Alasan Pembayaran wajib diisi',
            'status.required' => 'Status Pembayaran wajib diisi',
        ]);

        Peminjaman::where('id', $id)->update($validated);

        return redirect()->route('data-peminjaman.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $peminjamans = Peminjaman::where('id', $id)->first();
        $peminjamans->delete();

        return redirect()->route('data-peminjaman.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }

    public function disetujui($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 'Disetujui',
        ]);
        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Peminjaman');
    }

    public function ditolak($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 'Ditolak',
        ]);
        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Peminjaman');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class AdminStatusPinjamanController extends Controller
{

    // Proses
    public function proses()
    {
        $peminjamans = Peminjaman::where('status', 'Proses')->latest()->get();
        return view('admin.data-pinjaman.proses', [
            'peminjamans' => $peminjamans,
        ]);
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

    // Disetujui
    public function indexdisetujui()
    {
        $peminjamans = Peminjaman::where('status', 'Disetujui')->latest()->get();
        return view('admin.data-pinjaman.disetujui', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function dikembalikan($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 'Dikembalikan',
        ]);
        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Peminjaman');
    }

    // Dikembalikan
    public function indexdikembalikan()
    {
        $peminjamans = Peminjaman::where('status', 'Dikembalikan')->latest()->get();
        return view('admin.data-pinjaman.dikembalikan', [
            'peminjamans' => $peminjamans,
        ]);
    }

    public function diselesaikan($id)
    {
        Peminjaman::where('id', $id)->update([
            'status' => 'Selesai',
        ]);
        return back()->with('success', 'Selamat ! Anda berhasil memperbaharui Peminjaman');
    }

    // Selesai
    public function indexselesai()
    {
        $peminjamans = Peminjaman::where('status', 'Selesai')->latest()->get();
        return view('admin.data-pinjaman.selesai', [
            'peminjamans' => $peminjamans,
        ]);
    }
}

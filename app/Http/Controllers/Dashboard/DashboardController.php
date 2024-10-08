<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;
use App\Models\JadwalPanen;
use App\Models\Level;
use App\Models\Pekerja;
use App\Models\Pembelian;
use App\Models\Peminjaman;
use App\Models\Penjualan;
use App\Models\Petani;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $levels = Level::count();
        $petanis = Petani::count();
        $pekerjas = Pekerja::count();
        $jadwals = JadwalPanen::count();
        $hargas = HargaSawit::count();
        $pembelians = Pembelian::count();
        $penjualans = Penjualan::count();
        $peminjamans = Peminjaman::count();

        // Mengambil data pembelian per bulan untuk tahun ini berdasarkan field 'tanggal'
        $pembelianBulanan = Pembelian::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereYear('tanggal', Carbon::now()->year) // Filter untuk tahun ini
            ->groupBy('bulan') // Mengelompokkan berdasarkan bulan
            ->pluck('total', 'bulan')->toArray();

        // Mengisi data bulan yang tidak ada dengan nilai 0
        $pembelianPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pembelianPerBulan[$i] = $pembelianBulanan[$i] ?? 0;
        }

        // Mengambil data penjualan per bulan untuk tahun ini berdasarkan field 'tanggal'
        $penjualanBulanan = Penjualan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereYear('tanggal', Carbon::now()->year) // Filter untuk tahun ini
            ->groupBy('bulan') // Mengelompokkan berdasarkan bulan
            ->pluck('total', 'bulan')->toArray();

// Mengisi data bulan yang tidak ada dengan nilai 0 untuk penjualan
        $penjualanPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $penjualanPerBulan[$i] = $penjualanBulanan[$i] ?? 0;
        }

        return view('admin.dashboard.index', [
            'users' => $users,
            'levels' => $levels,
            'petanis' => $petanis,
            'pekerjas' => $pekerjas,
            'jadwals' => $jadwals,
            'hargas' => $hargas,
            'pembelians' => $pembelians,
            'penjualans' => $penjualans,
            'peminjamans' => $peminjamans,

            'pembelianPerBulan' => $pembelianPerBulan,
            'penjualanPerBulan' => $penjualanPerBulan,
        ]);
    }

    // Edit Biodata Petani
    public function editbiodatapetani($id)
    {
        $petanis = Petani::where('id', $id)->first();
        return view('petani.edit-biodata', [
            'petanis' => $petanis,
        ]);
    }

    public function updatebiodatapetani(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'telp' => 'required|min:10|max:15',
            'alamat_domisili' => 'required',
            'alamat_kebun' => 'required',
        ], [
            'nama.required' => 'Nama Lengkap wajib diisi',
            'telp.required' => 'Telepon wajib diisi',
            'telp.min' => 'Telepon minimal 10 karakter',
            'telp.max' => 'Telepon maksimal 15 karakter',
            'alamat_domisili.required' => 'Alamat Domisili wajib diisi',
            'alamat_kebun.required' => 'Alamat Kebun wajib diisi',
        ]);

        Petani::where('id', $id)->update($validated);

        return redirect('dashboard')->with('success', 'Selamat ! Anda berhasil memperbaharui data!');
    }
}

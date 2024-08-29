<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerja;
use App\Models\Pembelian;
use App\Models\Upah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminUpahController extends Controller
{
    public function index()
    {
        $upahs = Upah::latest()->get();
        return view('admin.upah.index', [
            'upahs' => $upahs,
        ]);
    }

    public function create()
    {
        $carbons = Carbon::now()->format('m');
        $pembelians = Pembelian::whereMonth('tanggal', $carbons)->latest()->get();
        return view('admin.upah.create', [
            'pembelians' => $pembelians,
        ]);
    }

    public function store(Request $request)
    {
        $bulan = $request->input('bulan') ?? Carbon::now()->month;
        $tahun = $request->input('tahun') ?? Carbon::now()->year;

        $pekerjas = Pekerja::all();

        foreach ($pekerjas as $pekerja) {
            // Total sebagai supir
            $totalTBSsupir = $pekerja->pembeliansSebagaiSupir()
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('quantity_tbs');

            // Total sebagai pemuat
            $totalTBSpemuat = $pekerja->pembeliansSebagaiPemuat()
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('quantity_tbs');

            // Besar upah per ton TBS
            $upahPerTon = 100000;

            // Total gaji
            $totalGaji = ($totalTBSsupir + $totalTBSpemuat) * $upahPerTon;

            // Menyimpan ke tabel `upahs`
            Upah::create([
                'pekerja_id' => $pekerja->id,
                'bulan' => "$tahun-$bulan",
                'jumlah' => $totalTBSsupir + $totalTBSpemuat,
                'upah' => $upahPerTon,
                'tot_gaji' => $totalGaji,
            ]);
        }

        return redirect()->route('data-upah.index')->with('success', 'Gaji berhasil dihitung dan disimpan.');
    }

}

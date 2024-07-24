<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;
use App\Models\Pekerja;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupirPenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::where('supir_id', Auth::user()->pekerja_id)->latest()->get();
        return view('supir.penjualan.index', [
            'penjualans' => $penjualans,
        ]);
    }

    public function create()
    {
        $hargas = HargaSawit::latest()->first();
        return view('supir.penjualan.create', [
            'hargas' => $hargas,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_penjualan' => 'required',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_penjualan.required' => 'Total Penjualan wajib diisi',
        ]);

        $validated['supir_id'] = Auth::user()->pekerja_id;

        Penjualan::create($validated);

        return redirect()->route('supir-penjualan.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $hargas = HargaSawit::latest()->first();
        $penjualans = Penjualan::where('id', $id)->first();
        return view('supir.penjualan.edit', [
            'hargas' => $hargas,
            'penjualans' => $penjualans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_penjualan' => 'required',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_penjualan.required' => 'Total Penjualan wajib diisi',
        ]);

        Penjualan::where('id', $id)->update($validated);

        return redirect()->route('supir-penjualan.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $penjualans = Penjualan::where('id', $id)->first();
        $penjualans->delete();

        return redirect()->route('supir-penjualan.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;
use App\Models\Pekerja;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class AdminPenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::latest()->get();
        return view('admin.penjualan.index', [
            'penjualans' => $penjualans,
        ]);
    }

    public function create()
    {
        $supirs = Pekerja::where('level_id', '3')->latest()->get();
        $hargas = HargaSawit::latest()->first();
        return view('admin.penjualan.create', [
            'supirs' => $supirs,
            'hargas' => $hargas,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supir_id' => 'required',
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_penjualan' => 'required',
        ], [
            'supir_id.required' => 'Supir wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_penjualan.required' => 'Total Penjualan wajib diisi',
        ]);

        Penjualan::create($validated);

        return redirect()->route('data-penjualan.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $supirs = Pekerja::where('level_id', '3')->latest()->get();
        $hargas = HargaSawit::latest()->first();
        $penjualans = Penjualan::where('id', $id)->first();
        return view('admin.penjualan.edit', [
            'supirs' => $supirs,
            'hargas' => $hargas,
            'penjualans' => $penjualans,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'supir_id' => 'required',
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_penjualan' => 'required',
        ], [
            'supir_id.required' => 'Supir wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_penjualan.required' => 'Total Penjualan wajib diisi',
        ]);

        Penjualan::where('id', $id)->update($validated);

        return redirect()->route('data-penjualan.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $penjualans = Penjualan::where('id', $id)->first();
        $penjualans->delete();

        return redirect()->route('data-penjualan.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

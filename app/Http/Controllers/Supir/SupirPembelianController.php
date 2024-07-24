<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;
use App\Models\Pekerja;
use App\Models\Pembelian;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupirPembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::where('supir_id', Auth::user()->pekerja_id)->latest()->get();
        return view('supir.pembelian.index', [
            'pembelians' => $pembelians,
        ]);
    }

    public function create()
    {
        $petanis = Petani::latest()->get();
        $pemuats = Pekerja::where('level_id', '4')->latest()->get();
        $hargas = HargaSawit::latest()->first();
        return view('supir.pembelian.create', [
            'petanis' => $petanis,
            'pemuats' => $pemuats,
            'hargas' => $hargas,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemuat_id' => 'required',
            'petani_id' => 'required',
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_pembelian' => 'required',
        ], [
            'pemuat_id.required' => 'Pemuat wajib diisi',
            'petani_id.required' => 'Petani wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_pembelian.required' => 'Total Pembelian wajib diisi',
        ]);

        $validated['supir_id'] = Auth::user()->pekerja_id;

        Pembelian::create($validated);

        return redirect()->route('supir-pembelian.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $petanis = Petani::latest()->get();
        $pemuats = Pekerja::where('level_id', '4')->latest()->get();
        $hargas = HargaSawit::latest()->first();
        $pembelians = Pembelian::where('id', $id)->first();
        return view('supir.pembelian.edit', [
            'petanis' => $petanis,
            'pemuats' => $pemuats,
            'hargas' => $hargas,
            'pembelians' => $pembelians,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pemuat_id' => 'required',
            'petani_id' => 'required',
            'tanggal' => 'required',
            'quantity_tbs' => 'required',
            'total_tbs' => 'required',
            'quantity_berondolan' => 'required',
            'total_berondolan' => 'required',
            'total_pembelian' => 'required',
        ], [
            'pemuat_id.required' => 'Pemuat wajib diisi',
            'petani_id.required' => 'Petani wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'quantity_tbs.required' => 'Jumlah TBS wajib diisi',
            'total_tbs.required' => 'Total TBS wajib diisi',
            'quantity_berondolan.required' => 'Jumlah Berondolan wajib diisi',
            'total_berondolan.required' => 'Total Berondolan wajib diisi',
            'total_pembelian.required' => 'Total Pembelian wajib diisi',
        ]);

        Pembelian::where('id', $id)->update($validated);

        return redirect()->route('supir-pembelian.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $pembelians = Pembelian::where('id', $id)->first();
        $pembelians->delete();

        return redirect()->route('supir-pembelian.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

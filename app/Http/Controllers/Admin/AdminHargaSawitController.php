<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;
use Illuminate\Http\Request;

class AdminHargaSawitController extends Controller
{
    public function index()
    {
        $hargas = HargaSawit::latest()->get();
        return view('admin.harga-sawit.index', [
            'hargas' => $hargas,
        ]);
    }

    public function create()
    {
        return view('admin.harga-sawit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'harga_tbs' => 'required',
            'harga_berondolan' => 'required',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'harga_tbs.required' => 'Harga TBS wajib diisi',
            'harga_berondolan.required' => 'Harga Berondolan wajib diisi',
        ]);

        HargaSawit::create($validated);

        return redirect()->route('data-hargasawit.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }

    public function edit($id)
    {
        $hargas = HargaSawit::find($id);
        return view('admin.harga-sawit.edit', [
            'hargas' => $hargas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'harga_tbs' => 'required',
            'harga_berondolan' => 'required',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi',
            'harga_tbs.required' => 'Harga TBS wajib diisi',
            'harga_berondolan.required' => 'Harga Berondolan wajib diisi',
        ]);

        HargaSawit::where('id', $id)->update($validated);

        return redirect()->route('data-hargasawit.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $hargas = HargaSawit::where('id', $id)->first();
        $hargas->delete();

        return redirect()->route('data-hargasawit.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

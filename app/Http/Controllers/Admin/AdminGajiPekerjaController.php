<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use Illuminate\Http\Request;

class AdminGajiPekerjaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pekerja_id' => 'required',
            'gaji_pekerja' => 'required',
        ], [
            'pekerja_id.required' => 'Pekerja wajib diisi',
            'gaji_pekerja.required' => 'Gaji Pekerja wajib diisi',
        ]);

        Gaji::create($validated);

        return redirect()->route('data-pekerja.index')->with('success', 'Selamat ! Anda berhasil menambahkan gaji pekerja');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'pekerja_id' => 'required',
            'gaji_pekerja' => 'required',
        ], [
            'pekerja_id.required' => 'Pekerja wajib diisi',
            'gaji_pekerja.required' => 'Gaji Pekerja wajib diisi',
        ]);

        Gaji::where('id', $request->id)->update($validated);

        return redirect()->route('data-pekerja.index')->with('success', 'Selamat ! Anda berhasil memperbaharui gaji pekerja');
    }
}

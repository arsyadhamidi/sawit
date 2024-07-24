<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class AdminLevelController extends Controller
{
    public function index()
    {
        $levels = Level::latest()->get();
        return view('admin.level.index', [
            'levels' => $levels,
        ]);
    }

    public function create()
    {
        return view('admin.level.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namalevel' => 'required',
            'id_level' => 'required',
        ], [
            'id_level.required' => 'ID Status wajib diisi',
            'namalevel.required' => 'Nama Status wajib diisi',
        ]);

        Level::create($validated);

        return redirect()->route('data-level.index')->with('success', 'Selamat ! Anda berhasil menambahkan data');
    }
    
    public function edit($id)
    {
        $levels = Level::find($id);
        return view('admin.level.edit', [
            'levels' => $levels
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'namalevel' => 'required',
            'id_level' => 'required',
        ], [
            'id_level.required' => 'ID Status wajib diisi',
            'namalevel.required' => 'Nama Status wajib diisi',
        ]);

        Level::where('id', $id)->update($validated);

        return redirect()->route('data-level.index')->with('success', 'Selamat ! Anda berhasil memperbaharui data');
    }

    public function destroy($id)
    {
        $levels = Level::where('id', $id)->first();
        $levels->delete();

        return redirect()->route('data-level.index')->with('success', 'Selamat ! Anda berhasil menghapus data');
    }
}

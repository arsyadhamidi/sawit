<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        return view('admin.dashboard.index', [
            'users' => $users,
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

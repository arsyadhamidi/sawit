<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function updateprofile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'telp' => 'required|min:10|max:15',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'name.min' => 'Nama Lengkap minimal 10 karakter',
            'name.max' => 'Nama Lengkap maksimal 15 karakter',
            'telp.required' => 'Nomor Telepon wajib diisi',
        ]);

        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();
        $users->update($validated);

        return redirect()->route('setting.index')->with('success', 'Selamat ! Anda berhasil memperbaharui profile');
    }

    public function updateusername(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah tersedia',
        ]);

        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();
        $users->update($validated);

        return redirect()->route('setting.index')->with('success', 'Selamat ! Anda berhasil memperbaharui username');
    }

    public function updatepassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:8',
            'konfirmasi' => 'required|min:8|same:password',
        ], [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'konfirmasi.required' => 'Konfirmasi Password wajib diisi',
            'konfirmasi.min' => 'Konfirmasi Password minimal 8 karakter',
            'konfirmasi.same' => 'Konfirmasi password harus sama dengan password',
        ]);

        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();
        $users->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('setting.index')->with('success', 'Selamat ! Anda berhasil memperbaharui password');
    }

    public function updategambar(Request $request)
    {
        $validated = $request->validate([
            'foto_profile' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], [
            'foto_profile.required' => 'Foto Profile wajib diisi',
            'foto_profile.mimes' => 'Foto Profile harus memiliki format PNG, JPEG, atau JPG',
            'foto_profile.max' => 'Foto Profile maksimal 2 MB',
        ]);

        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();

        if ($request->file('foto_profile')) {
            if ($users->foto_profile) {
                Storage::delete($users->foto_profile);
            }
            $validated['foto_profile'] = $request->file('foto_profile')->store('foto_profile');
        } else {
            $validated['foto_profile'] = $users->foto_profile;
        }

        $users->update($validated);

        return redirect()->route('setting.index')->with('success', 'Selamat ! Anda berhasil memperbaharui foto profile');
    }

    public function hapusgambar()
    {
        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();

        if ($users->foto_profile) {
            Storage::delete($users->foto_profile);
        }

        $users->update([
            'foto_profile' => null,
        ]);

        return redirect('setting')->with('success', 'Selamat! Anda berhasil menghapus foto profile');
    }

}

<?php

namespace App\Http\Controllers\Petani;

use App\Models\Petani;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetaniPembelianController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $petanis = Petani::where('users_id', $users->id)->first();
        $pembelians = Pembelian::where('petani_id', $petanis->id)->latest()->get();
        return view('petani.pembelian.index', [
            'pembelians' => $pembelians,
        ]);
    }
}

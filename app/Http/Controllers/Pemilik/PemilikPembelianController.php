<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;

class PemilikPembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::latest()->get();
        return view('pemilik-usaha.pembelian.index', [
            'pembelians' => $pembelians,
        ]);
    }
}

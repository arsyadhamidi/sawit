<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemilikPenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::latest()->get();
        return view('pemilik-usaha.penjualan.index', [
            'penjualans' => $penjualans,
        ]);
    }
}

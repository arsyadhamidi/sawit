<?php

namespace App\Http\Controllers\Petani;

use App\Models\HargaSawit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetaniHargaSawitController extends Controller
{
    public function index()
    {
        $hargas = HargaSawit::latest()->get();
        return view('petani.harga-sawit.index', [
            'hargas' => $hargas,
        ]);
    }
}

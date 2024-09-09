<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HargaSawit;

class ApiDashboardPageController extends Controller
{
    public function hargasawit()
    {
        $hargas = HargaSawit::latest()->first();
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data Berhasil Di Tampilkan',
            'data' => $hargas,
        ]);
    }
}

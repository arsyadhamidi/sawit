<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerja;

class AdminUpahController extends Controller
{
    public function index()
    {
        $pekerjas = Pekerja::latest()->get();
        return view('admin.upah.index', [
            'pekerjas' => $pekerjas,
        ]);
    }

    public function show($id)
    {
        $pekerjas = Pekerja::where('id', $id)->first();
        return view('admin.upah.show', [

        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'petani_id');
    }

    public function supir()
    {
        return $this->belongsTo(Pekerja::class, 'supir_id');
    }

    public function pemuat()
    {
        return $this->belongsTo(Pekerja::class, 'pemuat_id');
    }
}

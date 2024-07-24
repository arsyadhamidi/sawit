<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supir()
    {
        return $this->belongsTo(Pekerja::class, 'supir_id');
    }
}

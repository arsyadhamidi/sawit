<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class, 'pekerja_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPanen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'petani_id');
    }
}

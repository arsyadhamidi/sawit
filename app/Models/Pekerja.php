<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id_level');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'pekerja_id');
    }

    public function gaji()
    {
        return $this->hasOne(Gaji::class, 'pekerja_id');
    }

    public function upah()
    {
        return $this->hasOne(Upah::class, 'pekerja_id');
    }

    public function pembeliansSebagaiSupir()
    {
        return $this->hasMany(Pembelian::class, 'supir_id');
    }

    public function pembeliansSebagaiPemuat()
    {
        return $this->hasMany(Pembelian::class, 'pemuat_id');
    }
}

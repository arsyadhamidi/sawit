<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id');
            $table->string('waktu_panen');
            $table->string('luas_kebun');
            $table->string('lokasi_kebun');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_panens');
    }
};

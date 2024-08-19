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
        Schema::create('upahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pekerja_id');
            $table->string('bulan');
            $table->string('jumlah');
            $table->string('upah');
            $table->string('tot_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upahs');
    }
};

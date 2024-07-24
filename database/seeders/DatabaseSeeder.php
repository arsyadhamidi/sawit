<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Level::create([
            'id_level' => '1',
            'namalevel' => 'Admin',
        ]);

        Level::create([
            'id_level' => '2',
            'namalevel' => 'Petani',
        ]);

        Level::create([
            'id_level' => '3',
            'namalevel' => 'Supir',
        ]);

        Level::create([
            'id_level' => '4',
            'namalevel' => 'Pemuat',
        ]);

        Level::create([
            'id_level' => '5',
            'namalevel' => 'Pemilik Usaha',
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'password' => bcrypt('12345678'),
            'level_id' => '1',
            'telp' => '082385950243',
        ]);
    }
}

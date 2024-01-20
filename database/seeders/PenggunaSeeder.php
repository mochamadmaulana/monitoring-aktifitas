<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'nama_lengkap' => 'Mochamad Maulana',
            'role' => 'Admin',
            'username' => strtolower('mochamadmaulana'),
            'email' => 'mochamad.maulana@raharja.info',
            'password' => Hash::make('123'),
        ]);
        $pengguna = User::create([
            'nama_lengkap' => 'Eneng Indriyanih',
            'role' => 'Pengguna',
            'username' => strtolower('indriyanih'),
            'email' => 'eneng.indriyanih03@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\BankDompet;
use App\Models\Rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankDompetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $e_dompet = BankDompet::insert([
            [
                'jenis' => 'E-Dompet',
                'nama' => 'Dana',
            ],
            [
                'jenis' => 'E-Dompet',
                'nama' => 'ShopeePay',
            ],
            [
                'jenis' => 'Bank',
                'nama' => 'Bank Rakyat Indonesia',
            ],
            [
                'jenis' => 'Bank',
                'nama' => 'Bank Central Asia',
            ],
            [
                'jenis' => 'Bank',
                'nama' => 'SeeBank',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank = Rekening::insert([
            [
                'jenis' => 'Bank',
                'nama' => 'Bank Rakyat Indonesia',
                'nomor_rekening' => '384801059503539',
                'user_id' => '1',
            ],
            [
                'jenis' => 'Bank',
                'nama' => 'Bank Central Asia',
                'nomor_rekening' => '7125131921',
                'user_id' => '1',
            ],
            [
                'jenis' => 'Bank',
                'nama' => 'SeeBank',
                'nomor_rekening' => '901165398910',
                'user_id' => '1',
            ],
        ]);
        $e_dompet = Rekening::insert([
            [
                'jenis' => 'E-Dompet',
                'nama' => 'Dana',
                'nomor_rekening' => '083874966186',
                'user_id' => '1',
            ],
            [
                'jenis' => 'E-Dompet',
                'nama' => 'ShopeePay',
                'nomor_rekening' => '081389710228',
                'user_id' => '1',
            ],
        ]);
    }
}

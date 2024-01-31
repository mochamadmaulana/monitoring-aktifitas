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
        Rekening::insert([
            [
                'bank_dompet_id' => '3',
                'pemilik_id' => '1',
                'nomor_rekening' => '384801059503539',
            ],
            [
                'bank_dompet_id' => '4',
                'pemilik_id' => '1',
                'nomor_rekening' => '7125131921',
            ],
            [
                'bank_dompet_id' => '5',
                'pemilik_id' => '1',
                'nomor_rekening' => '901165398910',
            ],
            [
                'bank_dompet_id' => '1',
                'pemilik_id' => '1',
                'nomor_rekening' => '083874966186',
            ],
            [
                'bank_dompet_id' => '2',
                'pemilik_id' => '1',
                'nomor_rekening' => '081389710228',
            ],
        ]);
    }
}

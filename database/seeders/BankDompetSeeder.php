<?php

namespace Database\Seeders;

use App\Models\BankDompet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankDompetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank = BankDompet::insert([
            [
                'jenis' => 'Bank',
                'nama' => '(BRI) Bank Rakyat Indonesia',
            ],
            [
                'jenis' => 'Bank',
                'nama' => '(BNI) Bank Negara Indonesia',
            ],
            [
                'jenis' => 'Bank',
                'nama' => '(BCA) Bank Central Asia',
            ],
        ]);
        $e_dompet = BankDompet::insert([
            [
                'jenis' => 'Dompet',
                'nama' => 'Dana',
            ],
            [
                'jenis' => 'Dompet',
                'nama' => 'OVO',
            ],
            [
                'jenis' => 'Dompet',
                'nama' => 'Shopee Pay',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periksas')->insert([
            [
                'id_pasien' => 1,
                'id_dokter' => 3,
                'tgl_periksa' => '2025-03-24 16:00:00',
                'catatan' => 'keluhan demam',
                'biaya_periksa' => 50000
            ],
            [
                'id_pasien' => 1,
                'id_dokter' => 3,
                'tgl_periksa' => '2025-03-24 16:00:00',
                'catatan' => 'keluhan sakit flu',
                'biaya_periksa' => 30000
            ],
        ]);
    }
}


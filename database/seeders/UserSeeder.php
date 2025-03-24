<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'dr. Tirta',
                'alamat' => 'Semarang',
                'no_hp' => '0852378123761',
                'email' => 'tirta.dokter@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'dokter'
            ],
            [
                'nama' => 'dr. Boyke',
                'alamat' => 'Semarang',
                'no_hp' => '0852378123787',
                'email' => 'boyke.dokter@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'dokter'
            ],
            [
                'nama' => 'mukti',
                'alamat' => 'jogja',
                'no_hp' => '0852376793756',
                'email' => 'mukti.pasien@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pasien'
            ],
            [
                'nama' => 'cipeng',
                'alamat' => 'Semarang',
                'no_hp' => '0852345678986',
                'email' => 'cipeng.pasien@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pasien'
            ],
        ]);
    }
}

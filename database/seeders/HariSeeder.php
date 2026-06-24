<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hari = [
            ['hari' => 'Senin'],
            ['hari' => 'Selasa'],
            ['hari' => 'Rabu'],
            ['hari' => 'Kamis'],
            ['hari' => 'Jumat'],
            ['hari' => 'Sabtu'],
            ['hari' => 'Minggu'],
        ];
        DB::table('r_hari')->insert($hari);
    }
}

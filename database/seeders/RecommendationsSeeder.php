<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('recommendations')->insert([
            'head_id' => 1,
            'name' => 'STALO',
            'jumlah_unit_needed' => '1 units',
            'year' => 2021,

            'created_at' => now()
        ]);
        DB::table('recommendations')->insert([
            'head_id' => 2,
            'name' => 'Moxa',
            'jumlah_unit_needed' => '1 units',
            'year' => 2021,

            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}

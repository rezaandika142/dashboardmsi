<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ltfu;

class LtfuTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ltfu::factory(50)->create(); // Membuat 50 data dummy Ltfu
        //Ltfu::factory()->count(50)->create(); // cara alternatif
    }
}
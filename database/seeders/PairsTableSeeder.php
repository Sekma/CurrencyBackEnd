<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pairs;

class PairsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchangeRatios = [
            ['currency_1_id' => 1, 'currency_2_id' => 2, 'exchange' => 0.90],
            ['currency_1_id' => 2, 'currency_2_id' => 1, 'exchange' => 1.11],
            ['currency_1_id' => 3, 'currency_2_id' => 1, 'exchange' => 0.33],
            ['currency_1_id' => 1, 'currency_2_id' => 3, 'exchange' => 3.05],
            ['currency_1_id' => 3, 'currency_2_id' => 2, 'exchange' => 0.29],
            ['currency_1_id' => 2, 'currency_2_id' => 3, 'exchange' => 3.39],
           ];

        foreach ($exchangeRatios as $ratio) {
            Pairs::create($ratio);
        }
    }
}

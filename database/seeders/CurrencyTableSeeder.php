<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::factory()->count(3)->sequence(
            ['name' => 'USD'],
            ['name' => 'EUR'],
            ['name' => 'TND']
           )->create();
    }
}

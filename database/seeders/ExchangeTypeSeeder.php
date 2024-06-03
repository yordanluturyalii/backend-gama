<?php

namespace Database\Seeders;

use App\Models\ExchangeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wasteType = new ExchangeType();
        $wasteType->name = "Minyak";
        $wasteType->save();

        $wasteType = new ExchangeType();
        $wasteType->name = "Beras";
        $wasteType->save();

        $wasteType = new ExchangeType();
        $wasteType->name = "Telur";
        $wasteType->save();
    }
}

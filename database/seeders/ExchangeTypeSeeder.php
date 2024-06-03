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
        $wasteType->name = "Minyak 1/2 Liter";
        $wasteType->save();

        $wasteType = new ExchangeType();
        $wasteType->name = "Beras 1 Kg";
        $wasteType->save();

        $wasteType = new ExchangeType();
        $wasteType->name = "Telur 1/2 Liter";
        $wasteType->save();
    }
}

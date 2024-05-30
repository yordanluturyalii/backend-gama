<?php

namespace Database\Seeders;

use App\Models\WasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wasteType = new WasteType();
        $wasteType->name = "Plastik";
        $wasteType->save();

        $wasteType = new WasteType();
        $wasteType->name = "Kertas";
        $wasteType->save();
        
        $wasteType = new WasteType();
        $wasteType->name = "Karton";
        $wasteType->save();

        $wasteType = new WasteType();
        $wasteType->name = "Besi";
        $wasteType->save();

        $wasteType = new WasteType();
        $wasteType->name = "Kayu";
        $wasteType->save();
    }
}

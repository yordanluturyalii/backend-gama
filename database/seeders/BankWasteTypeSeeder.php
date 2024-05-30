<?php

namespace Database\Seeders;

use App\Models\BankWasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankWasteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5;$i++) {
            $bankWasteType = new BankWasteType();
            $bankWasteType->waste_bank_id = random_int(1, 5);
            $bankWasteType->waste_type_id = random_int(1, 5);
            $bankWasteType->price = random_int(1000, 10000);
            $bankWasteType->save();
        } 
    }
}

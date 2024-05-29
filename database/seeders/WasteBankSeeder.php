<?php

namespace Database\Seeders;

use App\Models\WasteBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 5; $i++){
            $wasteBank = new WasteBank();
            $wasteBank->name = "Bank Sampah $i";
            $wasteBank->address = "Jalan $i";
            $wasteBank->phone_number = "081234567$i";
            $wasteBank->email = "banksampah$i@gmail.com";
            $wasteBank->password = "password$i";
            $wasteBank->save();
        }
    }
}

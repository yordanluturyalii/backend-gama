<?php

namespace Database\Seeders;

use App\Models\StoreTransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreTransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'store_transaction_id',
        // 'bank_waste_type_id',
        // 'qty',
        $storeTransactionDetail = new StoreTransactionDetail();
        $storeTransactionDetail->store_transaction_id = 1;
        $storeTransactionDetail->bank_waste_type_id = 1;
        $storeTransactionDetail->qty = 1;
        $storeTransactionDetail->save();
    }
}

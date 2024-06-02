<?php

namespace Database\Seeders;

use App\Models\StoreTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'user_id',
        // 'waste_bank_id',
        // 'total',
        // 'transaction_type',
        // 'address',
        // 'visit_date',
        $storeTransaction = new StoreTransaction();
        $storeTransaction->user_id = 1;
        $storeTransaction->waste_bank_id = 2;
        $storeTransaction->total = 100;
        $storeTransaction->transaction_type = 0;
        $storeTransaction->address = "nganu";
        $storeTransaction->visit_date = now();
        $storeTransaction->save();
    }
}

<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'store_transaction_id',
        // 'exchange_transaction_id',
        // 'status',
        // 'date'
        $transactionStatus = new TransactionStatus();
        $transactionStatus->store_transaction_id = 1;
        $transactionStatus->status = 0;
        $transactionStatus->date = now();
        $transactionStatus->save();
    }
}

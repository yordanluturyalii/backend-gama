<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepositHistoryResource;
use App\Models\BankWasteType;
use App\Models\StoreTransaction;
use App\Models\StoreTransactionDetail;
use App\Models\TransactionStatus;
use App\Models\WasteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryDepositController extends Controller
{
    public function getHistory()
    {
        $user = Auth::user();
        $history = StoreTransaction::query()->where('user_id', $user->id)->with('transactionStatuses')->with('wasteBank')->get();
        return response()->json([
            'message' => 'Success Get Data',
            'data' => DepositHistoryResource::collection($history)
        ], 200);
    }

    public function getDetailHistory($transactionId)
    {
        $user = Auth::user();

        $transaction = StoreTransaction::query()->find($transactionId)->with('wasteBank')->with('storeTransactionDetails')->where('user_id', $user->id)->first();
        $transactionStatus = TransactionStatus::query()->where('store_transaction_id', $transactionId)->first();

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        $waste = $transaction->storeTransactionDetails->map(function ($transactionDetail) {
            $bankWasteTypes = BankWasteType::query()
                ->where('id', $transactionDetail->bank_waste_type_id)
                ->with('WasteType')
                ->get(); 

            return $bankWasteTypes->map(function ($bankWasteType) {
                return $bankWasteType->WasteType;
            });
        });
        $qty = $transaction->storeTransactionDetails->map(function ($transactionDetail) {
            return $transactionDetail->qty;
        });
        $price = $transaction->storeTransactionDetails->map(function ($transactionDetail) {
            $bankWasteTypes = BankWasteType::query()
                ->where('id', $transactionDetail->bank_waste_type_id)
                ->with('WasteType')
                ->get(); 

            return $bankWasteTypes->map(function ($bankWasteType) {
                return $bankWasteType;
            });
        });

        $wasteTypes = $waste->flatten();

        $prices = $price->flatten();

        $wasteTypeNames = $wasteTypes->pluck('name');
        $wastePrice = $prices->pluck('price');

        
        return response()->json([
            'message' => 'Success Get Data',
            'data' => [
                'waste_bank_id' => $transaction->wasteBank->id,
                'waste_bank' => $transaction->wasteBank->name,
                'trash' => [
                    'waste_type' => $wasteTypeNames,
                    'qty' => $qty,
                    'coin' => $wastePrice,
                    'total_coin' => $transaction->total,
                ],
                'statuses' => [
                    'status' => $transactionStatus->status,
                    'date' => $transactionStatus->date
                ]
            ]
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WasteBankCollection;
use App\Http\Resources\WasteTypeCollection;
use App\Http\Resources\WasteTypeResource;
use App\Models\BankExchangeType;
use App\Models\BankWasteType;
use App\Models\ExchangeTransaction;
use App\Models\ExchangeTransactionDetail;
use App\Models\StoreTransaction;
use App\Models\StoreTransactionDetail;
use App\Models\TransactionStatus;
use App\Models\WasteBank;
use App\Repository\WasteBank\WasteBankRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DepositTrashController extends Controller
{
    public function __construct(private WasteBankRepository $wasteBankRepository)
    {
    }

    public function depositTrash(Request $request)
    {
        try {
            $data = [
                'waste_bank' => $request->waste_bank,
                'waste_type' => $request->waste_type,
                'qty' => $request->qty,
                'price' => $request->price,
                'transaction_type' => $request->transaction_type,
                'address' => $request->address,
                'visit_date' => $request->visit_date
            ];
            $rules = [
                'waste_bank' => ['required'],
                'waste_type' => ['required'],
                'qty' => ['required'],
                'price' => ['required'],
                'transaction_type' => ['required'],
                'address' => Rule::requiredIf(fn () => $request->transaction_type == 1),
                'visit_date' => Rule::requiredIf(fn () => $request->transaction_type == 0)
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = Auth::user();

            $storeTransaction = new StoreTransaction();
            $storeTransaction->user_id = $user->id;
            $storeTransaction->waste_bank_id = $request->waste_bank;
            $storeTransaction->transaction_type = $request->transaction_type;
            $storeTransaction->address = $request->address;
            $storeTransaction->visit_date = $request->visit_date;
            $storeTransaction->save();

            $bankWasteTypes = [];

            foreach ($request->waste_type as $index => $wasteTypeId) {
                $bankWasteType = new BankWasteType();
                $bankWasteType->waste_bank_id = $request->waste_bank;
                $bankWasteType->waste_type_id = $wasteTypeId;
                if (is_array($request->qty) && isset($request->qty[$index])) {
                    $bankWasteType->price = $request->price[$index];
                } else {
                    $bankWasteType->price = 0;
                }
                $bankWasteType->save();

                $bankWasteTypes[] = $bankWasteType;
            }

            $totalAmount = 0;

            foreach ($bankWasteTypes as $index => $bank) {
                $storeTransactionDetail = new StoreTransactionDetail();
                $storeTransactionDetail->store_transaction_id = $storeTransaction->id;
                $storeTransactionDetail->bank_waste_type_id = $bank->id;
                if (is_array($request->qty) && isset($request->qty[$index])) {
                    $storeTransactionDetail->qty = $request->qty[$index];
                    $amount = $request->price[$index] * $request->qty[$index];
                    $totalAmount += $amount;
                } else {
                    $storeTransactionDetail->qty = 0;
                }
                $storeTransactionDetail->save();
            }

            $storeTransaction->total = $totalAmount;
            $storeTransaction->save();

            $transactionStatus = new TransactionStatus();
            $transactionStatus->store_transaction_id = $storeTransaction->id;
            $transactionStatus->status = 0;
            $transactionStatus->date = now();
            $transactionStatus->save();

            return response()->json([
                'message' => 'Success Added Data'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => "Invalid Fields",
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function exchange(Request $request)
    {
        try {
            $data = [
                'waste_bank' => $request->waste_bank,
                'exchange_type' => $request->exchange_type,
                'qty' => $request->qty,
                'price' => $request->price,
                'transaction_type' => $request->transaction_type,
                'address' => $request->address,
                'visit_date' => $request->visit_date
            ];
            $rules = [
                'waste_bank' => ['required'],
                'exchange_type' => ['required'],
                'qty' => ['required'],
                'price' => ['required'],
                'transaction_type' => ['required'],
                'address' => Rule::requiredIf(fn () => $request->transaction_type == 1),
                'visit_date' => Rule::requiredIf(fn () => $request->transaction_type == 0)
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = Auth::user();

            $exchangeTransaction = new ExchangeTransaction();
            $exchangeTransaction->user_id = $user->id;
            $exchangeTransaction->waste_bank_id = $request->waste_bank;
            $exchangeTransaction->transaction_type = $request->transaction_type;
            $exchangeTransaction->address = $request->address;
            $exchangeTransaction->visit_date = $request->visit_date;
            $exchangeTransaction->save();

            $bankExchangeTypes = [];

            foreach ($request->exchange_type as $index => $exchangeTypeId) {
                $bankExchangeType = new BankExchangeType();
                $bankExchangeType->waste_bank_id = $request->waste_bank;
                $bankExchangeType->exchange_type_id = $exchangeTypeId;
                if (is_array($request->qty) && isset($request->qty[$index])) {
                    $bankExchangeType->price = $request->price[$index];
                } else {
                    $bankExchangeType->price = 0;
                }
                $bankExchangeType->save();

                $bankExchangeTypes[] = $bankExchangeType;
            }

            $totalAmount = 0;

            foreach ($bankExchangeTypes as $index => $bank) {
                $exchangeTransactionDetail = new ExchangeTransactionDetail();
                $exchangeTransactionDetail->exchange_transaction_id = $exchangeTransaction->id;
                $exchangeTransactionDetail->bank_exchange_type_id = $bank->id;
                if (is_array($request->qty) && isset($request->qty[$index])) {
                    $exchangeTransactionDetail->qty = $request->qty[$index];
                    $amount = $request->price[$index] * $request->qty[$index];
                    $totalAmount += $amount;
                } else {
                    $exchangeTransactionDetail->qty = 0;
                }
                $exchangeTransactionDetail->save();
            }

            $exchangeTransaction->total = $totalAmount;
            $exchangeTransaction->save();

            $transactionStatus = new TransactionStatus();
            $transactionStatus->exchange_transaction_id = $exchangeTransaction->id;
            $transactionStatus->status = 0;
            $transactionStatus->date = now();
            $transactionStatus->save();

            return response()->json([
                'message' => 'Success Added Data'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => "Invalid Fields",
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function getWasteBank()
    {
        $wasteBanks = $this->wasteBankRepository->getDataWasteBank();
        return response()->json([
            'message' => 'Success Get Data',
            'data' => new WasteBankCollection($wasteBanks)
        ], 200);
    }

    public function getWasteType(Request $request)
    {
        $wasteTypes = $this->wasteBankRepository->getDataWasteTypeByWasteBank($request->waste_bank);

        return response()->json([
            'message' => 'Success Get Data',
            'data' => new WasteTypeCollection($wasteTypes)
        ], 200);
    }

    public function getExchangeType(Request $request)
    {
        $exchangeTypes = $this->wasteBankRepository->getDataExchangeTypeByWasteBank($request->waste_bank);

        return response()->json([
            'message' => 'Success Get Data',
            'data' => new WasteTypeCollection($exchangeTypes)
        ], 200);
    }
}

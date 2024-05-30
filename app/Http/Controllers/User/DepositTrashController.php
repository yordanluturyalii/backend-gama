<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WasteBankCollection;
use App\Http\Resources\WasteTypeCollection;
use App\Http\Resources\WasteTypeResource;
use App\Models\WasteBank;
use App\Repository\WasteBank\WasteBankRepository;
use Illuminate\Http\Request;

class DepositTrashController extends Controller
{
    public function __construct(private WasteBankRepository $wasteBankRepository)
    {
        
    }

    public function depositTrash(Request $request) {
    }

    public function getWasteBank() {
        $wasteBanks = $this->wasteBankRepository->getDataWasteBank();
        return response()->json([
            'message' => 'Success Get Data',
            'data' => new WasteBankCollection($wasteBanks)
        ]);
    }

    public function getWasteType(Request $request) {
        $wasteTypes = $this->wasteBankRepository->getDataWasteTypeByWasteBank($request->waste_bank);

        return response()->json([
            'message' => 'Success Get Data',
            'data' => new WasteTypeCollection($wasteTypes)
        ]);
    }
}

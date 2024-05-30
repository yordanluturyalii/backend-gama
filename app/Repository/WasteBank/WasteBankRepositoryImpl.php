<?php

namespace App\Repository\WasteBank;

use App\Models\BankWasteType;
use App\Models\WasteBank;
use App\Models\WasteType;

class WasteBankRepositoryImpl implements WasteBankRepository {
    public function getDataWasteBank()
    {
        $wasteBank = WasteBank::query()->get();
        return $wasteBank; 
    }

    public function getDataWasteTypeByWasteBank($wasteBank)
    {
        $bankWasteTypes = BankWasteType::query()->where('waste_bank_id', $wasteBank)->get();
        
        $data = $bankWasteTypes->map(function($bankWasteType) {
            return WasteType::query()->where('id', $bankWasteType->waste_type_id)->first();
        });

        return $data;
    }
}
<?php

namespace App\Repository\WasteBank;

use App\Models\BankExchangeType;
use App\Models\BankWasteType;
use App\Models\ExchangeType;
use App\Models\WasteBank;
use App\Models\WasteType;

class WasteBankRepositoryImpl implements WasteBankRepository
{
    public function getDataWasteBank()
    {
        $wasteBank = WasteBank::query()->get();
        return $wasteBank;
    }

    public function getDataWasteTypeByWasteBank($wasteBank)
    {
        $bankWasteTypes = BankWasteType::query()->where('waste_bank_id', $wasteBank)->get();

        $wasteTypeIds = $bankWasteTypes->pluck('waste_type_id');

        $data = WasteType::query()->whereIn('id', $wasteTypeIds)->get();

        return $data;
    }

    public function getDataExchangeTypeByWasteBank($wasteBank)
    {
        $bankExchangeTypes = BankExchangeType::query()->where('waste_bank_id', $wasteBank)->get();

        $exchangeTypeIds = $bankExchangeTypes->pluck('exchange_type_id');

        $data = ExchangeType::query()->whereIn('id', $exchangeTypeIds)->get();

        return $data;
    }
}

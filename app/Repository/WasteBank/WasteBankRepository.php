<?php

namespace App\Repository\WasteBank;

interface WasteBankRepository {
    public function getDataWasteBank();
    public function getDataWasteTypeByWasteBank($wasteBank);
    public function getDataExchangeTypeByWasteBank($wasteBank);
}

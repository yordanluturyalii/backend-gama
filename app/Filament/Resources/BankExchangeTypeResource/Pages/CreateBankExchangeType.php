<?php

namespace App\Filament\Resources\BankExchangeTypeResource\Pages;

use App\Filament\Resources\BankExchangeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBankExchangeType extends CreateRecord
{
    protected static string $resource = BankExchangeTypeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['waste_bank_id'] = auth()->id();

        return $data;
    }
}

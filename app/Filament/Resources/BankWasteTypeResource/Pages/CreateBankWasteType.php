<?php

namespace App\Filament\Resources\BankWasteTypeResource\Pages;

use App\Filament\Resources\BankWasteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBankWasteType extends CreateRecord
{
    protected static string $resource = BankWasteTypeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['waste_bank_id'] = auth()->id();

        return $data;
    }
}

<?php

namespace App\Filament\Resources\BankExchangeTypeResource\Pages;

use App\Filament\Resources\BankExchangeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankExchangeType extends EditRecord
{
    protected static string $resource = BankExchangeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

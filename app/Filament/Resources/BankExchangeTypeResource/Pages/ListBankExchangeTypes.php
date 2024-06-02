<?php

namespace App\Filament\Resources\BankExchangeTypeResource\Pages;

use App\Filament\Resources\BankExchangeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankExchangeTypes extends ListRecords
{
    protected static string $resource = BankExchangeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

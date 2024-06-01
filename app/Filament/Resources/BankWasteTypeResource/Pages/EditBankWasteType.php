<?php

namespace App\Filament\Resources\BankWasteTypeResource\Pages;

use App\Filament\Resources\BankWasteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankWasteType extends EditRecord
{
    protected static string $resource = BankWasteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

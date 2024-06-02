<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankExchangeTypeResource\Pages;
use App\Filament\Resources\BankExchangeTypeResource\RelationManagers;
use App\Models\BankExchangeType;
use App\Models\ExchangeType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankExchangeTypeResource extends Resource
{
    protected static ?string $model = BankExchangeType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('waste_bank_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('exchange_type_id')
                    ->required()
                    ->options(ExchangeType::all()->pluck('name', 'id')),
                TextInput::make('price')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exchangeType.name'),
                TextColumn::make('price')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankExchangeTypes::route('/'),
            'create' => Pages\CreateBankExchangeType::route('/create'),
            'edit' => Pages\EditBankExchangeType::route('/{record}/edit'),
        ];
    }
}

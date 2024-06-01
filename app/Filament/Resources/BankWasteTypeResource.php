<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankWasteTypeResource\Pages;
use App\Filament\Resources\BankWasteTypeResource\RelationManagers;
use App\Models\BankWasteType;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankWasteTypeResource extends Resource
{
    protected static ?string $model = BankWasteType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('waste_bank_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('waste_type_id')
                    ->required()
                    ->options(WasteType::all()->pluck('name', 'id')),
                TextInput::make('price')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('WasteType.name'),
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
            'index' => Pages\ListBankWasteTypes::route('/'),
            'create' => Pages\CreateBankWasteType::route('/create'),
            'edit' => Pages\EditBankWasteType::route('/{record}/edit'),
        ];
    }
}

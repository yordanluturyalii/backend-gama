<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionStatusResource\Pages;
use App\Filament\Resources\TransactionStatusResource\RelationManagers;
use App\Models\TransactionStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionStatusResource extends Resource
{
    protected static ?string $model = TransactionStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SelectColumn::make('status')
                    ->options([
                        0 => 'Menunggu Konfirmasi',
                        1 => 'Disetujui',
                        2 => 'Ditolak',
                    ])
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
            'index' => Pages\ListTransactionStatuses::route('/'),
            // 'create' => Pages\CreateTransactionStatus::route('/create'),
            'edit' => Pages\EditTransactionStatus::route('/{record}/edit'),
        ];
    }
}

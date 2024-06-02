<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionStatusResource\Pages;
use App\Filament\Resources\TransactionStatusResource\RelationManagers;
use App\Models\TransactionStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
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
                Split::make([
                    Stack::make([
                        TextColumn::make('storeTransaction.user.full_name'),
                        TextColumn::make('exchangeTransaction.user.full_name'),
                    ]),
                    Stack::make([
                        TextColumn::make('storeTransaction.transaction_type')
                        ->label('Transaction Type')
                        ->sortable()
                        ->formatStateUsing(fn ($state): string => match ($state) {
                            0 => 'Antar sendiri',
                            1 => 'Penjemputan'
                        })
                        ->badge()
                        ->color(fn ($state): string => match ($state) {
                            0 => 'gray',
                            1 => 'gray'
                        }),
                        TextColumn::make('exchangeTransaction.transaction_type')
                            ->label('Transaction Type')
                            ->sortable()
                            ->formatStateUsing(fn ($state): string => match ($state) {
                                0 => 'Ambil sendiri',
                                1 => 'Antar ke rumah'
                            })
                            ->badge()
                            ->color(fn ($state): string => match ($state) {
                                0 => 'gray',
                                1 => 'gray'
                            }),
                    ]),
                    SelectColumn::make('status')
                    ->options([
                        0 => 'Menunggu Konfirmasi',
                        1 => 'Disetujui',
                        2 => 'Ditolak',
                    ]),
                    TextColumn::make('date')
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            // 'edit' => Pages\EditTransactionStatus::route('/{record}/edit'),
        ];
    }
}

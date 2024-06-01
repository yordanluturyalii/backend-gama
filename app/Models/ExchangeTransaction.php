<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExchangeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'waste_bank_id',
        'total',
        'transaction_type',
        'address',
        'visit_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wasteBank(): BelongsTo
    {
        return $this->belongsTo(WasteBank::class);
    }

    public function exchangeTransactionDetails(): HasMany
    {
        return $this->hasMany(ExchangeTransactionDetail::class);
    }

    public function transactionStatuses(): HasMany
    {
        return $this->hasMany(TransactionStatus::class);
    }
}

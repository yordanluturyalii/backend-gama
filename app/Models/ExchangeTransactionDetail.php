<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeTransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'exchange_transaction_id',
        'bank_waste_type_id',
        'qty',
    ];

    public function exchangeTransaction(): BelongsTo
    {
        return $this->belongsTo(ExchangeTransaction::class);
    }

    public function bankExchangeType(): BelongsTo
    {
        return $this->belongsTo(BankExchangeType::class);
    }
}

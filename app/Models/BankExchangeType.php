<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankExchangeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_bank_id',
        'exchange_type_id',
        'price',
    ];

    public function WasteBank(): BelongsTo
    {
        return $this->belongsTo(WasteBank::class);
    }

    public function exchangeType(): BelongsTo
    {
        return $this->belongsTo(ExchangeType::class);
    }
}

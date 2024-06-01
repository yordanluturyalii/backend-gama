<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExchangeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function exchangeTransactionDetails(): HasMany
    {
        return $this->hasMany(ExchangeTransactionDetail::class);
    }

    public function bankExchangeTypes(): HasMany
    {
        return $this->hasMany(BankExchangeType::class);
    }
}

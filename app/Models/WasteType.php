<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WasteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function storeTransactionDetails(): HasMany
    {
        return $this->hasMany(StoreTransactionDetail::class);
    }

    public function BankWasteTypes(): HasMany
    {
        return $this->hasMany(BankWasteType::class);
    }
}

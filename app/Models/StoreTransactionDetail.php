<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreTransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_transaction_id',
        'bank_waste_type_id',
        'qty',
    ];

    public function storeTransaction(): BelongsTo
    {
        return $this->belongsTo(StoreTransaction::class);
    }

    public function wasteType(): BelongsTo
    {
        return $this->belongsTo(BankWasteType::class);
    }
}

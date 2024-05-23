<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_transaction_id',
        'status',
        'date'
    ];

    public function storeTransaction(): BelongsTo
    {
        return $this->belongsTo(StoreTransaction::class);
    }
}

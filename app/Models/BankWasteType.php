<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankWasteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_bank_id',
        'waste_type_id',
        'price',
    ];

    public function WasteBank(): BelongsTo
    {
        return $this->belongsTo(WasteBank::class);
    }

    public function WasteType(): BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }
}

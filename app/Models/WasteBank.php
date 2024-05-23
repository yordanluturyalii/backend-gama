<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WasteBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function storeTransactions(): HasMany
    {
        return $this->hasMany(StoreTransaction::class);
    }
}

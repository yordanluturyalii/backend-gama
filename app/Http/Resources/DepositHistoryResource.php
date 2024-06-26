<?php

namespace App\Http\Resources;

use App\Models\TransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'waste_bank' => $this->wasteBank->only('id', 'name'),
            'deposit_date' => $this->created_at,
            'status' => TransactionStatusResource::collection($this->transactionStatuses)
        ];
    }
}

<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'costumerId' => $this->costumer_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'billedData' => $this->billed_data,
            'paidData' => $this->paid_data,
        ];
    }
}

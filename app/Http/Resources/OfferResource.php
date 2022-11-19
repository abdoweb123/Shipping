<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_id'=>$this->order_id,
            'deliveryMan_id'=>$this->deliveryMan->name,
            'comment'=>$this->comment,
            'offeredPrice'=>$this->offeredPrice,
            'accepted'=>$this->accepted,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,

        ];
    }


}

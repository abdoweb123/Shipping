<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user->name,
            'order_id'=>$this->order_id,
            'comment'=>$this->comment,
            'rate'=>$this->rate,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }


}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'job'=>$this->job->job_description,
            'userName'=>$this->user->full_name,
            'message'=>$this->message,
            'active'=>$this->active,
            'accepted'=>$this->accepted,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }

}

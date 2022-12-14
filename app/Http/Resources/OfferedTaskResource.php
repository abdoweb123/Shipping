<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferedTaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'job'=>$this->job->job_description,
            'job Task'=>$this->jobTask_id,
            'offer'=>$this->offer_id,
            'active'=>$this->active,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }

}

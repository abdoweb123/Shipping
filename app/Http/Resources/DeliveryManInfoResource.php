<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryManInfoResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'password'=>$this->password,
            'email'=>$this->email,
            'birthdate'=>$this->birthdate,
            'toolBackLicenceImage'=>asset('assets/images/DeliveryMen/' . $this->toolBackLicenceImage),
            'toolFrontLicenceImage'=>asset('assets/images/DeliveryMen/' . $this->toolFrontLicenceImage),
            'toolType_id'=>$this->toolType_id,
            'nationalityFrontIdImage'=>asset('assets/images/DeliveryMen/' . $this->nationalityFrontIdImage),
            'nationalityBackIdImage'=>asset('assets/images/DeliveryMen/' . $this->nationalityBackIdImage),
            'profileImage'=>asset('assets/images/DeliveryMen/' . $this->profileImage),
            'state_id'=>$this->state_id,
            'active' =>$this->active,
            'working'=>$this->working,
            'type'=>$this->type,
            'lat'=>$this->lat,
            'long'=>$this->long,
            'wallet'=>$this->wallet,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}



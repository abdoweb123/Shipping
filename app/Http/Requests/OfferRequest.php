<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'job_id'=>'required',
            'user_id'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'job_id.required'=>'اسم االوظيفة مطلوب',
            'user_id.required'=>'اسم الموظف مطلوب',
        ];
    }

}

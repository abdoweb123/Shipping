<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferedTaskRequest extends FormRequest
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
            'jobTask_id'=>'required',
            'offer_id'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'job_id.required'=>'اسم االوظيفة مطلوب',
            'user_id.required'=>'اسم الموظف مطلوب',
            'jobTask_id.required'=>'اسم الممهمة مطلوب',
            'offer_id.required'=>'اسم العرض مطلوب',
        ];
    }

}

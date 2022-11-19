<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'user_id'=>'required',
            'order_id'=>'required',
            'comment'=>'required',
            'rate'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'user_id.required'=>'اسم المستخدم مطلوب',
            'order_id.required'=>'اسم الطلب مطلوب',
            'comment.required'=>'التعليق مطلوب',
            'rate.required'=>'التقييم مطلوب',
        ];
    }

}

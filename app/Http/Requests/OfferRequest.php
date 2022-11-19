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
            'order_id'=>'required',
            'deliveryMan_id'=>'required',
            'comment'=>'required',
            'offeredPrice'=>'required',
            'accepted'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'order_id.required'=>'اسم الطلب مطلوب',
            'deliveryMan_id.required'=>'اسم السائق مطلوب',
            'comment.required'=>'التعليق مطلوب',
            'offeredPrice.required'=>'سعر العرض مطلوب',
            'accepted.required'=>'الموافقة مطلوبة',
        ];
    }

}

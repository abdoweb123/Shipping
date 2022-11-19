<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryManLoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => 'required|exists:delivery_men,email',
            'password' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'email.required'=>' البريد الإلكتروني مطلوب',
            'email.email'=>' البريد الإلكتروني يجب أن يكون صالحا',
            'email.exists'=>'هذا البريد غير موجود',
            'password.required'=>'كلمة المرور مطلوبة',
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required',
            'state_id' => 'required',
            'image' => 'required',
            'wallet' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم المستخدم مطلوب',
            'email.required'=>' البريد الإلكتروني مطلوب',
            'email.email'=>' البريد الإلكتروني يجب أن يكون صالحا',
            'email.unique' => 'هذ البريد الإلكتروني موجود بالفعل',
            'password.required'=>'كلمة المرور مطلوبة',
            'password.min'=>'كلمة المرور يجب أن تحتوي على 8 حروف على الأقل',
            'phone.required' => 'رقمم الهاتف مطلوب',
            'state_id.required' => 'اسم المدينة مطلوب',
            'image.required' => 'صورة بطاقة الهوية مطلوبة',
            'wallet.required' => 'مبلغ المحفظة مطلوب',
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم المستخدم مطلوب',
            'email.required'=>' البريد الإلكتروني مطلوب',
            'email.email'=>' البريد الإلكتروني يجب أن يكون صالحا',
            'password.required'=>'كلمة المرور مطلوبة',
            'password.min'=>'كلمة المرور يجب أن تحتوي على 8 حروف على الأقل',
        ];
    }

}

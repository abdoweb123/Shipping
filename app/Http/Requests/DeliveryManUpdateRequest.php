<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryManUpdateRequest extends FormRequest
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
            'name'                    =>'required',
            'phone'                   =>'required',
            'password'                =>'required',
            'email'                   =>'required|email',
            'birthdate'               =>'required',
            'toolType_id'             =>'required',
            'state_id'                =>'required',
            'active'                  =>'required',
            'working'                 =>'required',
            'type'                    =>'required',
            'lat'                     =>'required',
            'long'                    =>'required',
            'wallet'                  =>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم المستخدم مطلوب',
            'email.required'=>' البريد الإلكتروني مطلوب',
            'email.email'=>' البريد الإلكتروني يجب أن يكون صالحا',
            'password.required'=>'كلمة المرور مطلوبة',
            'phone.required' => 'رقمم الهاتف مطلوب',
            'state_id.required' => 'اسم المدينة مطلوب',
            'wallet.required' => 'مبلغ المحفظة مطلوب',
            'birthdate.required'=>'تاريخ الميلاد مطلوب',
            'toolType_id.required' =>'وسيلة النقل مطلوبة',
            'type.required'=>'نوع الشحن مطلوب (داخلي / خارجي)',
            'lat.required'=>'الإحداثيات مطلوبة',
            'long.required'=>'الإحداثيات مطلوبة',
        ];
    }

}

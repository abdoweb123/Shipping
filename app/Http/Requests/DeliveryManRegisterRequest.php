<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryManRegisterRequest extends FormRequest
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
            'password'                =>'required|min:8',
            'email'                   =>'required|email|unique:delivery_Men',
            'birthdate'               =>'required',
            'toolBackLicenceImage'    =>'required|mimes:jpg,jpeg,png,svg',
            'toolFrontLicenceImage'   =>'required|mimes:jpg,jpeg,png,svg',
            'toolType_id'             =>'required',
            'nationalityFrontIdImage' =>'required|mimes:jpg,jpeg,png,svg',
            'nationalityBackIdImage'  =>'required|mimes:jpg,jpeg,png,svg',
            'profileImage'            =>'required|mimes:jpg,jpeg,png,svg',
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
            'email.unique' => 'هذ البريد الإلكتروني موجود بالفعل',
            'password.required'=>'كلمة المرور مطلوبة',
            'password.min'=>'كلمة المرور يجب أن تحتوي على 8 حروف على الأقل',
            'phone.required' => 'رقمم الهاتف مطلوب',
            'state_id.required' => 'اسم المدينة مطلوب',
            'wallet.required' => 'مبلغ المحفظة مطلوب',
            'birthdate.required'=>'تاريخ الميلاد مطلوب',
            'toolBackLicenceImage.required'=>'الصورة الخلفية للرخصة مطلوبة',
            'toolFrontLicenceImage.required'=>'الصورة الأمامية للرخصة مطلوب',
            'toolType_id.required' =>'وسيلة النقل مطلوبة',
            'nationalityFrontIdImage.required' =>'صورة بطاقة الرقم القومي الأمامية مطلوبة',
            'nationalityBackIdImage.required'=>'صورة بطاقة الرقم القومي الخلفية مطلوبة',
            'profileImage.required' =>'الصورة الشخصية مطلوبة',
            'type.required'=>'نوع الشحن مطلوب (داخلي / خارجي)',
            'lat.required'=>'الإحداثيات مطلوبة',
            'long.required'=>'الإحداثيات مطلوبة',
        ];
    }

}

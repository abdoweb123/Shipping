<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StateStoreRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'image' => 'required',
            'image.*' => 'mimes:png,jpeg,jpg,svg',
            'numberOfOrders' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم باللغة العربية مطلوب',
            'name_en.required' => 'الاسم باللغة الإنجليزية مطلوب',
            'image.required' => 'صورة المحافظة مطلوبة',
            'image.mimes' => 'png,jpeg,jpg,svg يجب أن تكون الصورة من نوع ',
            'numberOfOrders.required' => 'عدد الطلبات مطلوب',
        ];
    }


}

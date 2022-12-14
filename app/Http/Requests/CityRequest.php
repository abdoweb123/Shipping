<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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



    public function rules()
    {
        return [
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم باللغة العربية مطلوب',
            'name_en.required' => 'الاسم باللغة الإنجليزية مطلوب',
            'country_id.required' => 'اسم الدولة مطلوب',
        ];
    }

}

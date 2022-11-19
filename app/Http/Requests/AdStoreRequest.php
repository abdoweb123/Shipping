<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'image' => 'required',
            'image.*' => 'image|mimes:png,jpeg,jpg,svg,gif',
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'صورة الإعلان مطلوبة',
            'image.mimes' => 'png,jpeg,jpg,svg يجب أن تكون الصورة من نوع ',
            'url.required' => 'الرابط الإلكتروني مطلوب',
        ];
    }


}

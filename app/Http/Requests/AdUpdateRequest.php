<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdUpdateRequest extends FormRequest
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
            'image.*' => 'mimes:png,jpeg,jpg',
            'url' => 'required',
            'active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'png,jpeg,jpg يجب أن تكون الصورة من نوع ',
            'url.required' => 'الرابط الإلكتروني مطلوب',
            'active.required' => 'حالة الإعلان مطلوبة',
        ];
    }


}

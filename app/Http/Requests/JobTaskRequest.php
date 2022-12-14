<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JobTaskRequest extends FormRequest
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
            'job_id' => 'required',
            'company_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'job_id.required' => 'الوظيفة مطلوب',
            'company_id.required' => 'اسم الشركة مطلوب',
            'name_ar.required' => 'اسم المهمة باللغة العربية مطلوب',
            'name_en.required' => 'اسم المهمة باللغة الإنجليزية مطلوب',
            'description_ar.required' => 'وصف المهمة باللغة العربية مطلوب',
            'description_en.required' => 'وصف المهمة باللغة العربية مطلوب',
        ];
    }

}

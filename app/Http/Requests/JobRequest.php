<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'company_id' => 'required',
            'city_id' => 'required',
            'specialization_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'duration_by_day' => 'required',
            'minimum_cost' => 'required',
            'maximum_cost' => 'required',
            'payment_type' => 'required',
            'job_type' => 'required',
            'job_description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => 'اسم الشركة مطلوب',
            'city_id.required' => 'اسم المدينة مطلوب',
            'specialization_id.required' => 'التخصص مطلوب',
            'latitude.required' => 'حقل خطوط العرض مطلوب',
            'longitude.required' => 'حقل خطوط الطول مطلوب',
            'duration_by_day.required' => 'وقت التنفيذ مطلوب',
            'minimum_cost.required' => 'حقل أقل تكلفة مطلوب',
            'maximum_cost.required' => 'حقل أكبر تكلفة مطلوب',
            'payment_type.required' => 'طريقة الدفع مطلوبة',
            'job_type.required' => 'نوع الوظيفة مطلوب',
            'job_description.required' => 'وصف الوظيفة مطلوب',
            'start_time.required' => 'تاريخ البداية مطلوب',
            'end_time.required' => 'تاريخ النهاية مطلوب',
        ];
    }

}

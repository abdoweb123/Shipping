<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'company_name_ar' => 'required',
            'company_name_en' => 'required',
            'company_email' => 'required|email|unique:companies',
            'company_phone' => 'required',
            'city_id' => 'required',
            'pre_fullName' => 'required',
            'pre_email' => 'required|email|unique:companies',
            'pre_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'commercialRecord_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'licence_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'pre_agent_image' => 'required|file|mimes:jpg,jpeg,png,svg',
            'national_address' => 'required',
            'services' => 'required',
            'jobs' => 'required',
            'contract_image' => 'required|file|mimes:jpg,jpeg,png,svg',
        ];
    }

    public function messages()
    {
        return [
            'company_name_ar.required' => 'اسم الشركة باللغة العربية مطلوب',
            'company_name_en.required' => 'اسم الشركة باللغة الانجليزية مطلوب',
            'company_email.required' => 'البريد الإلكتروني للشركة مطلوب',
            'company_email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
            'company_phone.required' => 'رقم هاتف الشركة مطلوب',
            'city_id.required' => 'اسم مدينة تواجد الشركة مطلوب',
            'pre_fullName.required' => 'الاسم الرباعي لممثل الشركة مطلوب',
            'pre_email.required' => 'البريد الإلكتروني لممثل الشركة مطلوب',
            'pre_email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
            'pre_image.required' => 'صورة هوية ممثل الشركة مطلوب',
            'pre_image.mimes' => 'يجب أن تكون صورة هوية ممثل الشركة من نوع jpg,jpeg,png,svg',
            'commercialRecord_image.required' => 'صورة السجل التجاري مطلوب',
            'commercialRecord_image.mimes' => 'يجب أن تكون صورة السجل التجاري من نوع jpg,jpeg,png,svg',
            'licence_image.required' => 'صورة الترخيص مطلوب',
            'licence_image.mimes' => 'يجب أن تكون صورة الترخيص من نوع jpg,jpeg,png,svg',
            'pre_agent_image.required' => 'صورة الوكالة الشرعية لممثل الشركة مطلوب',
            'pre_agent_image.mimes' => 'يجب أن تكون صورة الوكالة الشرعية لممثل الشركة من نوع jpg,jpeg,png,svg',
            'national_address.required' => 'العنوان الوطني مطلوب',
            'services.required' => 'خدمات الشركة مطلوب',
            'jobs.required' => 'الوظائف التي سيتم الإعلان عنها مطلوب',
            'contract_image.required' => 'صورة العقد بين الشركة وال R7 مطلوب',
            'contract_image.mimes' => 'يجب أن تكون صورة العقد بين الشركة وال R7 من نوع jpg,jpeg,png,svg',
        ];
    }

}

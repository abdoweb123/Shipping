<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'full_name' => 'required',
            'id_number' => 'required',
            'profile_image' => 'file|mimes:jpg,jpeg,png,svg',
            'identity_image' => 'file|mimes:jpg,jpeg,png,svg',
            'nationality_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'email' => 'required|email|unique:users',
            'area' => 'required',
            'workingArea_id' => 'required',
            'specialty_id' => 'required',
            'phone' => 'required',
            'relative_phone' => 'required',
            'gender' => 'required',
            'birthDate' => 'required',
            'health_insurance' => 'required',
            'antecedents' => 'required',
            'reachedUs_id' => 'required',
//            'arabic_video_url' => 'required|file|mimes:mp4,mov,ogg,qt',
//            'english_video_url' => 'file|mimes:mp4,mov,ogg,qt',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'الاسم بالكامل مطلوب',
            'id_number.required' => 'الرقم القومي مطلوب',
            'profile_image.required' => 'الصورة الشخصية مطلوب',
            'profile_image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,png,svg',
            'identity_image.required' => 'صورة بطاقة الهوية مطلوب',
            'identity_image.mimes' => 'يجب أن تكون الصورة من نوع jpg,jpeg,png,svg',
            'nationality_id.required' => 'الجنسية مطلوب',
            'country_id.required' => 'الدولة مطلوب',
            'city_id.required' => 'المدينة مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'هذا البريد الإلكتروني موجود بالفعل',
            'area.required' => 'العنوان بالتفصيل مطلوب',
            'workingArea_id.required' => 'منطقة العمل مطلوب',
            'specialty_id.required' => 'التخصص مطلوب',
            'phone.required' => 'الهاتف الشخصي مطلوب',
            'relative_phone.required' => 'هاتف قريب أو صاحب مطلوب',
            'gender.required' => 'النوع مطلوب',
            'birthDate.required' => 'تاريخ الميلاد مطلوب',
            'health_insurance.required' => 'الشهادة الصحية مطلوب',
            'antecedents.required' => 'الفيش و التشبيه مطلوب',
            'reachedUs_id.required' => 'كيف عرفتنا؟ مطلوب',
            'arabic_video_url.required' => 'فيديو التقديم بالعربية مطلوب',
            'arabic_video_url.mimes' => 'يجب أن يكون الفيديو من نوع mp4,mov,ogg,qt',
            'english_video_url.mimes' => 'يجب أن يكون الفيديو من نوع mp4,mov,ogg,qt',
        ];
    }

}

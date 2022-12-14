@extends('layouts.master')
@section('css')
@section('title')
    تعديل بيانات الموظف
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   تعديل بيانات الموظف
@stop
<!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @foreach(['danger','warning','success','info'] as $msg)
        @if(Session::has('alert-'.$msg))
            <div class="alert alert-{{$msg}}">
                {{Session::get('alert-'.$msg)}}
            </div>
        @endif
    @endforeach


    <!-- row mb-3 -->
    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">الاسم بالكامل</label>
                                <input id="name_ar" type="text" name="full_name" value="{{old('full_name', $user->full_name)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الرقم القومي</label>
                                <input type="number" name="id_number" value="{{old('id_number', $user->id_number)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الصورة الشخصية</label>
                                <input type="file" name="profile_image" value="{{old('profile_image', $user->profile_image)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">صورة بطاقة الهوية</label>
                                <input type="file" name="identity_image" value="{{old('identity_image', $user->identity_image)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الجنسية</label>
                                <select name="nationality_id" class="form-control">
                                    <option disabled >-- اختر --</option>
                                    @foreach($data['nationalities'] as $nationality)
                                        <option value="{{$nationality->id}}"  {{old('nationality_id') == $nationality->id ? 'selected' : ''}} {{$nationality->id == $user->nationality_id ? 'selected' : ''}}>{{$nationality->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الدولة</label>
                                <select name="country_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['countries'] as $country)
                                        <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ''}} {{$country->id == $user->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">المدينة</label>
                                <select name="city_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : ''}} {{$city->id == $user->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">البريد الإلكتروني</label>
                                <input type="email" name="email" value="{{old('email', $user->email)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">العنوان بالتفصيل</label>
                                <input type="text" name="area" value="{{old('area', $user->area)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">منطقة العمل</label>
                                <select name="workingArea_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['workingAreas'] as $workingArea)
                                        <option value="{{$workingArea->id}}" {{old('workingArea_id') == $workingArea->id ? 'selected' : ''}} {{$workingArea->id == $user->workingArea_id ? 'selected' : ''}}>{{$workingArea->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">التخصص</label>
                                <select name="specialty_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($data['specialties'] as $specialty)
                                        <option value="{{$specialty->id}}" {{old('specialty_id') == $specialty->id ? 'selected' : ''}} {{$specialty->id == $user->specialty_id ? 'selected' : ''}}>{{$specialty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الهاتف الشخصي</label>
                                <input type="text" name="phone" value="{{old('phone', $user->phone)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">هاتف قريب أو صاحب</label>
                                <input type="text" name="relative_phone" value="{{old('relative_phone', $user->relative_phone)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">النوع</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                    <div class="col">
                                        <input type="radio" name="gender" value="1" {{old('gender')=='1' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->gender == 1 ? 'checked' : ''}}> ذكر
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="gender" value="2" {{old('gender')=='2' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->gender == 2 ? 'checked' : ''}}> أنثى
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">تاريخ الميلاد</label>
                                <input type="date" name="birthDate" value="{{old('birthDate', $user->birthDate)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2 d-block">الشهادة الصحية</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                    <div class="col">
                                        <input type="radio" name="health_insurance" value="1" {{old('health_insurance')=='1' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->health_insurance == 1 ? 'checked' : ''}}>  يوجد
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="health_insurance" value="2" {{old('health_insurance')=='2' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->health_insurance == 2 ? 'checked' : ''}}> لا يوجد
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2 d-block">الفيش و التشبيه</label>
                                <div class="form-control row mb-3" style="display:flex !important; margin:0;">
                                    <div class="col">
                                        <input type="radio" name="antecedents" value="1" {{old('antecedents')=='1' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->antecedents == 1 ? 'checked' : ''}}> يوجد
                                    </div>
                                    <div class="col">
                                        <input type="radio" name="antecedents" value="2" {{old('antecedents')=='2' ? 'checked='.'"'.'checked='.'"' : ''}} {{$user->antecedents == 2 ? 'checked' : ''}}> لا يوجد
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">كيف عرفتنا؟</label>
                                <select name="reachedUs_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['reachedUs'] as $reachedUs)
                                        <option value="{{$reachedUs->id}}" {{old('reachedUs_id') == $reachedUs->id ? 'selected' : ''}} {{$reachedUs->id == $user->reachedUs_id ? 'selected' : ''}}>{{$reachedUs->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">فيديو التقديم بالعربية</label>
                                <input type="file" name="arabic_video_url" value="{{old('arabic_video_url')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">فيديو التقديم بالإنجليزية</label>
                                <input type="file" name="english_video_url" value="{{old('english_video_url')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                <select name="active" class="form-control">
                                    @if($user->active == 1)
                                        <option value="1" selected>نشط</option>
                                        <option value="2">غير نشط</option>
                                    @else
                                        <option value="1">نشط</option>
                                        <option value="2" selected>غير نشط</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <br><br>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
@endsection

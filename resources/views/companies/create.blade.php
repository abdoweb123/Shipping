@extends('layouts.master')
@section('css')
@section('title')
    إضافة شركة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   إضافة شركة
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
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">اسم الشركة بالعربية</label>
                                <input id="name_ar" type="text" name="company_name_ar" value="{{old('company_name_ar')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">اسم الشركة بالإنجليزية</label>
                                <input id="name_ar" type="text" name="company_name_en" value="{{old('company_name_en')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">البريد الإلكتروني للشركة</label>
                                <input type="email" name="company_email" value="{{old('company_email')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">صورة شعار الشركة</label>
                                <input type="file" name="logo_image" value="{{old('logo_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">صورة شكل الشركة</label>
                                <input type="file" name="cover_image" value="{{old('cover_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">رقم هاتف الشركة</label>
                                <input type="text" name="company_phone" value="{{old('company_phone')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">مدينة تواجد الشركة</label>
                                <select name="city_id" class="form-control">
                                    <option value=" " selected>-- اختر --</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">الاسم الرباعي لممثل الشركة</label>
                                <input type="text" name="pre_fullName" value="{{old('pre_fullName')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">البريد الإلكتروني لممثل الشركة</label>
                                <input type="email" name="pre_email" value="{{old('pre_email')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">صورة هوية ممثل الشركة</label>
                                <input type="file" name="pre_image" value="{{old('pre_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">صورة السجل التجاري</label>
                                <input type="file" name="commercialRecord_image" value="{{old('commercialRecord_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">صورة الترخيص</label>
                                <input type="file" name="licence_image" value="{{old('licence_image')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">صورة الوكالة الشرعية لممثل الشركة</label>
                                <input type="file" name="pre_agent_image" value="{{old('pre_agent_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">العنوان الوطني</label>
                                <input type="text" name="national_address" value="{{old('national_address')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">خدمات الشركة</label>
                                <input type="text" name="services" value="{{old('services')}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">الوظائف التي سيتم الإعلان عنها</label>
                                <input type="text" name="jobs" value="{{old('jobs')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">صورة العقد بين الشركة وال R7</label>
                                <input type="file" name="contract_image" value="{{old('contract_image')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                <select name="active" class="form-control">
                                    <option value="1" selected>نشط</option>
                                    <option value="2">غير نشط</option>
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

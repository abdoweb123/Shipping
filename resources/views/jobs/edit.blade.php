@extends('layouts.master')
@section('css')
@section('title')
    تعديل بيانات الوظيفة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   تعديل بيانات الوظيفة
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
                    <form action="{{ route('jobs.update',$job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">الشركة</label>
                                <select name="company_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['companies'] as $company)
                                        <option value="{{$company->id}}" {{old('company_id') == $company->id ? 'selected' : ''}} {{$company->id == $job->company_id ? 'selected' : ''}}>{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">المدينة</label>
                                <select name="city_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : ''}} {{$city->id == $job->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">التخصص</label>
                                <select name="specialization_id" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @foreach($data['specialties'] as $specialty)
                                        <option value="{{$specialty->id}}" {{old('specialization_id') == $specialty->id ? 'selected' : ''}} {{$specialty->id == $job->specialization_id ? 'selected' : ''}}>{{$specialty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">خطوط الطول</label>
                                <input type="number" step="0.1" name="longitude" value="{{old('longitude', $job->longitude)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">خطوط العرض</label>
                                <input type="number" step="0.1" name="latitude" value="{{old('latitude', $job->latitude)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">وقت التنفيذ بالأيام</label>
                                <input type="number" name="duration_by_day" value="{{old('duration_by_day', $job->duration_by_day)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">أقل تكلفة</label>
                                <input type="number" step="0.1" name="minimum_cost" value="{{old('minimum_cost', $job->minimum_cost)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">أكبر تكلفة</label>
                                <input type="number" step="0.1" name="maximum_cost" value="{{old('maximum_cost', $job->maximum_cost)}}" class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">نوع الوظيفة</label>
                                <select name="job_type" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @if($job->job_type == 1)
                                        <option value="1" selected>دوام جزئي</option>
                                        <option value="2">دوام كلي</option>
                                    @else
                                        <option value="1">دوام جزئي</option>
                                        <option value="2" selected>دوام كلي</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">طريقة الدفع</label>
                                <select name="payment_type" class="form-control">
                                    <option disabled>-- اختر --</option>
                                    @if($job->job_type == 1)
                                        <option value="1" selected>اليوم</option>
                                        <option value="2">المهمة</option>
                                    @else
                                        <option value="1">اليوم</option>
                                        <option value="2" selected>المهمة</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">تاريخ البداية</label>
                                <input type="date" name="start_time" value="{{old('start_time', $job->start_time)}}"  class="form-control">
                            </div>
                            <div class="col">
                                <label class="mr-sm-2">تاريخ النهاية</label>
                                <input type="date" name="end_time" value="{{old('end_time', $job->end_time)}}"  class="form-control">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="mr-sm-2">الحالة</label>
                                <select name="active" class="form-control">
                                    @if($job->active == 1)
                                        <option value="1" selected>نشط</option>
                                        <option value="2">غير نشط</option>
                                    @else
                                        <option value="1">نشط</option>
                                        <option value="2" selected>غير نشط</option>
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col">
                                <label class="mr-sm-2">وصف الوظيفة</label>
                                <textarea name="job_description" rows="6" class="form-control">{{old('job_description', $job->job_description)}}</textarea>
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

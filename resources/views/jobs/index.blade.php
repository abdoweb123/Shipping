@extends('layouts.master')
@section('css')
@section('title')
    قائمة الوظائف
@stop


<style>
    /*.process{border:none; border-radius:3px; padding:3px 5px;}*/
     select{padding:10px !important;}
    /*.process*/
    /*{*/
    /*    cursor:pointer;*/
    /*    background-color:white;*/
    /*    border-radius:3px;*/
    /*    border: 1px solid #dddd;*/
    /*    padding: 5px 3px 0 4px;*/
    /*    margin-left: 2px;*/
    /*}*/
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الوظائف
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

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


                    <a href="{{route('jobs.create')}}" class="button x-small">
                        إضافة وظيفة
                    </a>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشركة</th>
                                <th>اسم المدينة</th>
                                <th>اسم التخصص</th>
                                <th>اسم الموظف</th>
                                <th>خطوط الطول</th>
                                <th>خطوط العرض</th>
                                <th>وقت التنفيذ</th>
                                <th>أقل تكلفة</th>
                                <th>أكبر تكلفة</th>
                                <th>نوع الوظيفة</th>
                                <th>طريقة الدفع</th>
                                <th>وصف الوظيفة</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>بدأ</th>
                                <th>انتهى</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['jobs'] as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->city->name)  {{ $item->city->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->specialty->name)  {{ $item->specialty->name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->user->name)  {{ $item->user->name }} @else _____ @endisset</td>
                                    <td>{{$item->longitude}}</td>
                                    <td>{{$item->latitude}}</td>
                                    <td>{{$item->duration_by_day}}</td>
                                    <td>{{$item->minimum_cost}}</td>
                                    <td>{{$item->maximum_cost}}</td>
                                    <td>{{$item->job_type == 1 ? 'دوام جزئي' : 'دوام كلي'}}</td>
                                    <td>{{$item->payment_type == 1 ? 'اليوم' : 'المهمة'}}</td>
                                    <td>{{$item->job_description}}</td>
                                    <td>{{$item->start_time}}</td>
                                    <td>{{$item->end_time}}</td>
                                    <td>{{$item->started == true ? 'تم' : '___'}}</td>
                                    <td>{{$item->finished == true ? 'تم' : '___'}}</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
{{--                                        <a href="{{route('jobs.edit',$item->id)}}" class="process">--}}
{{--                                           <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></a>--}}

{{--                                        <button type="button" class="process" data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">--}}
{{--                                           <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>--}}

                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                العمليات
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{route('jobs.edit',$item->id)}}">
                                                    <i class="fa fa-edit" style="color: #ffc107"></i>&nbsp تعديل بيانات الوظيفة
                                                </a>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#delete{{ $item->id }}">
                                                    <i class="fa fa-trash" style="color: red"></i>&nbsp حذف الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobTasks.index',[$item->id, $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: goldenrod"></i>&nbsp مهمات الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobRequirements.index',[$item->id , $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: #68511b"></i>&nbsp متطلبات الوظيفة
                                                </a>

                                                <a class="dropdown-item" href="{{route('jobTerms.index',[$item->id, $item->company->id])}}">
                                                    <i class="fa fa-eye" style="color: #cbb175"></i>&nbsp شروط الوظيفة
                                                </a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <!--  page of delete_modal_city -->
                                @include('jobs.delete')


                            @endforeach
                        </table>

                        <div> {{$data['jobs']->links('pagination::bootstrap-4')}}</div>
                    </div>
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





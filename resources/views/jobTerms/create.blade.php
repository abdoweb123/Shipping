
@extends('layouts.master')
@section('css')
@section('title')
    شروط الوظيفة
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    شروط الوظيفة
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

    <h6 class="mb-4"><span style="border-radius: 5px; padding:5px"> <a href="{{route('returnJob',$job_id)}}"><span style="color:#8ea0db;">الوظيفة</span></a> / مهمات الوظيفة </span></a> / متطلبات الوظيفة</span></a> / شروط الوظيفة </span></h6>


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
                    <form action="{{ route('jobTerms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job_id}}">
                        <input type="hidden" name="company_id" value="{{$company_id}}">
{{--                        <input type="hidden" name="jobTask_id" value="{{$jobTask_id}}">--}}
{{--                        <input type="hidden" name="jobRequirement_id" value="{{$jobRequirement_id}}">--}}
                        <div class="row">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">اسم الشرط باللغة العربية</label>
                                <input id="name_ar" type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">اسم الشرط باللغة الإنجليزية</label>
                                <input id="name_en" type="text" name="name_en" value="{{old('name_en')}}" class="form-control">
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

    <div class="row mb-3">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الشرط باللغة العربية</th>
                                <th>اسم الشرط باللغة الإنجليزية</th>
                                <th>اسم الشركة</th>
                                <th>اسم الوظيفة</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($jobTerms as $item)
                                <tr>

                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar') }}</td>
                                    <td>{{ $item->getTranslation('name', 'en') }}</td>
                                    <td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
                                    <td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                            <i style="color:cadetblue; font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                            <i style="color:red; font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('jobTerms.edit')

                                <!--  page of delete_modal_city -->
                            @include('jobTerms.delete')


                            @endforeach
                        </table>

{{--                        <div> {{$jobTerms->links('pagination::bootstrap-4')}}</div>--}}
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

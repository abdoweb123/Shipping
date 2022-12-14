@extends('layouts.master')
@section('css')
@section('title')
   إضافة متطلب للوظيفة
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process
    {
        cursor:pointer;
        background-color:white;
        border-radius:3px;
        border: 1px solid #dddd;
        padding: 5px 3px 0 4px;
        margin-left: 2px;
    }
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    إضافة متطلب للوظيفة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <h6 class="mb-2"><span style="border-radius: 5px; padding:5px"> <a href="{{route('returnJob',$job_id)}}"><span style="color:#8ea0db;">الوظيفة</span></a> / متطلبات الوظيفة </span></h6>

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

                    <a href="{{route('jobRequirements.create',[$job_id, $company_id])}}" class="button x-small">
                        إضافة متطلب للوظيفة
                    </a>

                    @foreach(['danger','warning','success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <div class="alert alert-{{$msg}}">
                                {{Session::get('alert-'.$msg)}}
                            </div>
                        @endif
                    @endforeach

                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المتطلب باللغة العربية</th>
                                <th>اسم المتطلب باللغة الإنجليزية</th>
                                <th>اسم الشركة</th>
                                <th>اسم الوظيفة</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($jobRequirements as $item)
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
                                @include('jobRequirements.edit')

                                <!--  page of delete_modal_city -->
                                @include('jobRequirements.delete')


                            @endforeach
                        </table>

                        <div> {{$jobRequirements->links('pagination::bootstrap-4')}}</div>
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





@extends('layouts.master')
@section('css')
@section('title')
    قائمة الجنسيات
@stop


<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
</style>

@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    قائمة الجنسيات
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


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        إضافة جنسية
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الجنسية باللغة العربية</th>
                                <th>اسم الجنسية باللغة الإنجليزية</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($nationalities as $item)
                                <tr>

                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->getTranslation('name', 'ar') }}</td>
                                    <td>{{ $item->getTranslation('name', 'en') }}</td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>
                                        <button type="button" class="process" style="cursor:pointer; background-color:darkgoldenrod;"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                           <i style="color:white" class="fa fa-edit"></i></button>

                                        <button type="button" class="process" style="cursor:pointer; background-color: lightgray; border-radius:3px;"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('nationalities.edit')

                                <!--  page of delete_modal_city -->
                                @include('nationalities.delete')


                            @endforeach
                        </table>

                        <div> {{$nationalities->links('pagination::bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>


       <!--  page of add_modal_city -->
       @include('nationalities.create')
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





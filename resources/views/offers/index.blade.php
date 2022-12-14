@extends('layouts.master')
@section('css')
@section('title')
    قائمة العروض
@stop

<style>
    .process{border:none; border-radius:3px; padding:3px 5px;}
    select{padding:10px !important;}
    .process{border:none; border-radius:3px; padding:3px 5px;}
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
    قائمة العروض
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

                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>وصف الوظيفة</th>
                                <th>اسم الموظف</th>
                                <th>الحالة</th>
                                <th>القبول</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($offers as $item)
                                <tr>

                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->job->job_description }}</td>
                                    <td><a href="{{route('users.show',$item->user_id)}}" style="color:#e30000">{{ $item->user->full_name }}</a></td>
                                    <td>{{ $item->active == 1 ? 'نشط' : 'غير نشط'}}</td>
                                    <td>{{ $item->accepted == 1 ? 'مفعل' : 'غير مفعل'}}</td>
                                    <td>
                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#edit{{ $item->id }}" title="تعديل">
                                           <i style="color:cadetblue;  font-size:18px;" class="fa fa-edit"></i></button>

                                        <button type="button" class="process"
                                                data-toggle="modal" data-target="#delete{{ $item->id }}" title="حذف">
                                           <i style="color:red;  font-size:18px;" class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!--  page of edit_modal_city -->
                                @include('offers.edit')

                                <!--  page of delete_modal_city -->
                                @include('offers.delete')


                            @endforeach
                        </table>

                        <div> {{$offers->links('pagination::bootstrap-4')}}</div>
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





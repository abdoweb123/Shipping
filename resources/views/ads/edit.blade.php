<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل بيانات الإعلان
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('ads.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="image" class="mr-sm-2">اسم الصورة</label>
                            <input id="image" type="file" name="image[]" class="form-control" multiple>
                        </div>
                        <div class="col">
                            <label for="url" class="mr-sm-2">الرابط الإلكتروني</label>
                            <input id="url" type="text" name="url" value="{{ $item->url }}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="url" class="mr-sm-2">الحالة</label>
                            <select name="active" class="form-control mr-sm-2 p-2">
                                <option value="{{ $item->active }}">@if($item->active == 0) غير نشط @else نشط @endif</option>
                                @if( $item->active == 1)
                                    <option value="0"> غير نشط</option>
                                @else
                                    <option value="1"> نشط </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success">تعديل</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- edit_modal_city -->
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    تعديل بيانات وسيلة التواصل
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('reachedUs.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">اسم وسيلة التواصل بالعربية</label>
                            <input id="name_ar" type="text" name="name_ar" value="{{ $item->getTranslation('name', 'ar') }}" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">اسم وسيلة التواصل بالإنجليزية</label>
                            <input id="name_en" type="text" name="name_en" value="{{ $item->getTranslation('name', 'en') }}" class="form-control">
                        </div>
                    </div>

                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-success">إرسال</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

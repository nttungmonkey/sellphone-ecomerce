@extends('backend.layouts.master')

@section('title')
Products
@endsection

@section('custom-css')
<link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section('content-header')
Products
@endsection

@section('content-header-menu')
Products / Edit
@endsection

@section('content')
@include('backend.layouts.partials.error-message')
<form method="post" action="{{ route('products.update', [$product->sp_ma]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT" />
    <div class="form-group">
        <label for="l_ma">Loại sản phẩm</label>
        <select name="l_ma" class="form-control">
            @foreach($categorys as $category)
                @if($product->l_ma == $category->l_ma)
                <option value="{{ $category->l_ma }}" selected>{{ $category->l_ten }}</option>
                @else
                <option value="{{ $category->l_ma }}">{{ $category->l_ten }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sp_ten">Tên sản phẩm</label>
        <input type="text" class="form-control" id="sp_ten" name="sp_ten" value="{{ $product->sp_ten }}">
    </div>
    <div class="form-group">
        <label for="sp_giaGoc">Giá gốc</label>
        <input type="text" class="form-control" id="sp_giaGoc" name="sp_giaGoc" value="{{ $product->sp_giaGoc }}">
    </div>
    <div class="form-group">
        <label for="sp_giaBan">Giá bán</label>
        <input type="text" class="form-control" id="sp_giaBan" name="sp_giaBan" value="{{ $product->sp_giaBan }}">
    </div>
    <div class="form-group">
        <div class="file-loading">
            <label>Hình đại diện</label>
            <input id="sp_hinh" type="file" name="sp_hinh">
        </div>
    </div>
    <div class="form-group">
        <label for="sp_thongTin">Thông tin</label>
        <input type="text" class="form-control" id="sp_thongTin" name="sp_thongTin" value="{{ $product->sp_thongTin }}">
    </div>
    <div class="form-group">
        <label for="sp_danhGia">Đánh giá</label>
        <input type="text" class="form-control" id="sp_danhGia" name="sp_danhGia" value="{{ $product->sp_danhGia }}">
    </div>
    <div class="form-group">
        <label for="sp_taoMoi">Ngày tạo mới</label>
        <input type="text" class="form-control" id="sp_taoMoi" name="sp_taoMoi" value="{{ $product->sp_taoMoi }}" data-mask-datetime>
    </div>
    <div class="form-group">
        <label for="sp_capNhat">Ngày cập nhật</label>
        <input type="text" class="form-control" id="sp_capNhat" name="sp_capNhat" value="{{ $product->sp_capNhat }}" data-mask-datetime>
    </div>
    <select name="sp_trangThai" class="form-control">
        <option value="1" {{ $product->sp_trangThai == 1 ? "selected" : "" }}>Khóa</option>
        <option value="2" {{ $product->sp_trangThai == 2 ? "selected" : "" }}>Khả dụng</option>
    </select>
    <div class="form-group">
        <div class="file-loading">
            <label>Hình ảnh liên quan sản phẩm</label>
            <input id="sp_hinhanhlienquan" type="file" name="sp_hinhanhlienquan[]" multiple>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>
@endsection
@section('custom-scripts')
<!-- Bootstrap Fileinput -->
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
<!-- InputMask -->
<script src="{{ asset('vendor/input-mask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendor/input-mask/dist/bindings/inputmask.binding.js') }}"></script>
<script>
    $(function() {
        $("#sp_hinh").fileinput({
            theme: 'fas',
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            append: false,
            showRemove: false,
            autoReplace: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: false,
            initialPreviewShowDelete: false,
            initialPreviewAsData: true,
            initialPreview: [
                "{{ asset('storage/photos/' . $product->sp_hinh) }}"
            ],
            initialPreviewConfig: [
                {
                    caption: "{{ $product->sp_hinh }}", 
                    size: {{ Storage::exists('public/photos/' . $product->sp_hinh) ? Storage::size('public/photos/' . $product->sp_hinh) : 0 }}, 
                    width: "120px", 
                    url: "{$url}", 
                    key: 1
                },
            ]
        });
        $("#sp_hinhanhlienquan").fileinput({
            theme: 'fas',
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            append: false,
            showRemove: false,
            autoReplace: true,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: false,
            allowedFileExtensions: ["jpg", "gif", "png", "txt"],
            initialPreviewShowDelete: false,
            initialPreviewAsData: true,
            initialPreview: [
                @foreach($product->hinhanhlienquan()->get() as $hinhAnh)
                "{{ asset('storage/photos/' . $hinhAnh->ha_ten) }}",
                @endforeach
            ],
            initialPreviewConfig: [
                @foreach($product->hinhanhlienquan()->get() as $index=>$hinhAnh)
                {
                    caption: "{{ $hinhAnh->ha_ten }}", 
                    size: {{ Storage::exists('public/photos/' . $hinhAnh->ha_ten) ? Storage::size('public/photos/' . $hinhAnh->ha_ten) : 0 }}, 
                    width: "120px", 
                    url: "{$url}", 
                    key: {{ ($index + 1) }}
                },
                @endforeach
            ]
        });
        $('#sp_giaGoc').inputmask({
            alias: 'currency',
            positionCaretOnClick: "radixFocus",
            radixPoint: ".",
            _radixDance: true,
            numericInput: true,
            groupSeparator: ",",
            suffix: ' vnđ',
            min: 0,         // 0 ngàn
            max: 100000000, // 1 trăm triệu
            autoUnmask: true,
            removeMaskOnSubmit: true,
            unmaskAsNumber: true,
            inputtype: 'text',
            placeholder: "0",
            definitions: {
                "0": {
                validator: "[0-9\uFF11-\uFF19]"
                }
            }
        });
        $('#sp_giaBan').inputmask({
            alias: 'currency',
            positionCaretOnClick: "radixFocus",
            radixPoint: ".",
            _radixDance: true,
            numericInput: true,
            groupSeparator: ",",
            suffix: ' vnđ',
            min: 0,         // 0 ngàn
            max: 100000000, // 1 trăm triệu
            autoUnmask: true,
            removeMaskOnSubmit: true,
            unmaskAsNumber: true,
            inputtype: 'text',
            placeholder: "0",
            definitions: {
                "0": {
                validator: "[0-9\uFF11-\uFF19]"
                }
            }
            });
        $('#sp_taoMoi').inputmask({
            alias: 'datetime',
            inputFormat: 'yyyy-mm-dd' // Định dạng Năm-Tháng-Ngày
        });

        // Gắn mặt nạ nhập liệu cho các ô nhập liệu Ngày cập nhật
        $('#sp_capNhat').inputmask({
            alias: 'datetime',
            inputFormat: 'yyyy-mm-dd' // Định dạng Năm-Tháng-Ngày
        });
    });

</script>
@endsection
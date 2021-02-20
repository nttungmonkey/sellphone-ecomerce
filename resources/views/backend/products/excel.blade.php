<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        * {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>

<body style="font-size: 10px">
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
            <tr>
                <td colspan="6" align="center" style="font-size: 13px;" width="100">
                    <b>PHONETN</b></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="font-size: 13px">
                    <b>http://phonetn.com/</b></td>
            </tr>
            <tr>
                <td colspan="6" align="center" style="font-size: 13px">
                    <b>(+123) 123 321 345 # 01.222.888.999</b></td>
            </tr>
            <tr>
                <td colspan="6" align="center">
                    {{-- Đây là khoảng trống dùng để chèn ảnh LOGO bằng Laravel Excel --}}
                    {{-- Khi hiển thị ảnh để xem trên WEB -> sử dụng đường dẫn URL bằng hàm asset() --}}
                    {{-- Khi xuất file Excel, muốn chèn hình ảnh phải sử dụng đường dẫn PATH bằng hàm public_path() --}}
                    
                    {{-- Nếu muốn debug để xem mẫu in, bỏ comment dòng dưới đây --}}
                    {{-- <img src="{{ asset('img\icons.png') }}" /> --}}
                </td>
            </tr>
            <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>Product List</b>
                </td>
            </tr>
            <tr style="border: 1px thin #000">
                <th style="text-align: center">No</th>
                <th style="text-align: center">Image</th>
                <th style="text-align: center">Sku</th>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Models</th>
                <th style="text-align: center">Supplier</th>    
            </tr>
            @foreach ($products as $sp)
            <tr style="border: 1px thin #000">
                <td align="center" valign="middle" width="5">
                    {{ $loop->index + 1 }}
                </td>
                <td align="center" valign="middle" width="20" height="110">
                    {{-- Đây là khoảng trống dùng để chèn ảnh LOGO bằng Laravel Excel --}}
                    {{-- Khi hiển thị ảnh để xem trên WEB -> sử dụng đường dẫn URL bằng hàm asset() --}}
                    {{-- Khi xuất file Excel, muốn chèn hình ảnh phải sử dụng đường dẫn PATH bằng hàm public_path() --}}
                    
                    {{-- Nếu muốn debug để xem mẫu in, bỏ comment dòng dưới đây --}}
                    {{-- <img class="hinhSanPham" src="{{ asset('storage/photos/' . $sp->sp_hinh) }}" width="100" height="100" /> --}}
                </td>
                <td align="left" valign="middle" width="30">{{ $sp->pro_sku }}</td>
                <td align="right" valign="middle" width="30">{{ $sp->pro_name }}</td>
                @foreach ($models as $model)
                    @if ($sp->mod_id == $model->mod_id)
                    <td align="left" width="15" valign="middle">{{ $model->mod_name }}</td>
                    @endif
                @endforeach
                @foreach ($suppliers as $supplier)
                    @if ($sp->sup_id == $supplier->sup_id)
                    <td align="left" width="15" valign="middle">{{ $supplier->sup_name }}</td>
                    @endif
                @endforeach
                
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
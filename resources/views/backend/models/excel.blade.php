<!DOCTYPE html>
<html>

<head>
    <title>Model List</title>
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
                    <b>Model List</b>
                </td>
            </tr>
            <tr style="border: 1px thin #000">
                <th style="text-align: center">No</th>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Note</th>
                <th style="text-align: center">Manufacture</th>  
                <th style="text-align: center">Created At</th>
                <th style="text-align: center">Updated At</th>  
            </tr>
            @foreach ($models as $md)
            <tr style="border: 1px thin #000">
                <td align="center" valign="middle" width="5">
                    {{ $loop->index + 1 }}
                </td>
                <td align="left" valign="middle" width="30">{{ $md->mod_name }}</td>
                <td align="right" valign="middle" width="30">{{ $md->mod_note }}</td>
                @foreach ($manufactures as $manu)
                    @if ($md->mnf_id == $manu->mnf_id)
                    <td align="left" width="15" valign="middle">{{ $manu->mnf_name }}</td>
                    @endif
                @endforeach
                <td align="right" valign="middle" width="30">{{ $md->mod_created }}</td>
                <td align="right" valign="middle" width="30">{{ $md->mod_updated }}</td> 
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
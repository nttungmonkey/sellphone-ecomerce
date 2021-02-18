<!DOCTYPE html>
<html>

<head>
    <title>Supplier List</title>
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
                    <b>Supplier List</b>
                </td>
            </tr>
            <tr style="border: 1px thin #000">
                <th style="text-align: center">No</th>
                <th style="text-align: center">Name</th>
                <th style="text-align: center">Phone</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Address</th>
                <th style="text-align: center">Note</th>    
            </tr>
            @foreach ($suppliers as $sp)
            <tr style="border: 1px thin #000">
                <td align="center" valign="middle" width="5">
                    {{ $loop->index + 1 }}
                </td>
                <td align="left" valign="middle" width="30">{{ $sp->sup_name }}</td>
                <td align="right" valign="middle" width="30">{{ $sp->sup_phonenum }}</td>
                <td align="right" valign="middle" width="30">{{ $sp->sup_email }}</td>
                @foreach ($addresses as $address)
                    @if ($sp->adr_id == $address->adr_id)
                    <td align="left" width="15" valign="middle">{{ $address->adr_address }}</td>
                    @endif
                @endforeach
                <td align="right" valign="middle" width="30">{{ $sp->sup_note }}</td> 
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
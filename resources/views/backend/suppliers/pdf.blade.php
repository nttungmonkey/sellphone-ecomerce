<!DOCTYPE html>
<html>

<head>
    <title>Suppliers</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 10px;
        }

        table {
            border-collapse: collapse;
        }

        td {
            vertical-align: middle;
        }

        caption {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .hinhSanPham {
            width: 100px;
            height: 100px;
        }

        .companyInfo {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .companyImg {
            width: 100px;
            height: 100px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="row">
        <table border="0" align="center">
            <tr>
                <td class="companyInfo">
                    PHONETN<br />
                    http://phonetn.com/<br />
                    (+123) 123 321 345 # 01.222.888.999<br />
                    <img src="{{ public_path('storage\images\admin\logos\logo1.png') }}" class="companyImg" />
                </td>
            </tr>
        </table>
        <br />
        <br />
        <?php 
        $tongSoTrang = ceil(count($suppliers)/5);
         ?>
        <table border="1" align="center" cellpadding="5">
            <caption>Suppliers</caption>
            <tr>
                <th colspan="6" align="center">Pgae 1 / {{ $tongSoTrang }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Note</th>
            </tr>
            @foreach ($suppliers as $supplier)
            <tr>
                <td align="center">{{ $loop->index + 1 }}</td>
                <td align="left">{{ $supplier->sup_name }}</td>
                <td align="left">{{ $supplier->sup_phonenum }}</td>
                <td align="left">{{ $supplier->sup_email }}</td>
                @foreach ($addresses as $address)
                @if ($supplier->adr_id == $address->adr_id)
                <td align="left">{{ $address->adr_address }}</td>
                @endif
                @endforeach
                <td align="left">{{ $supplier->sup_note }}</td>
            </tr>
            @if (($loop->index + 1) % 5 == 0)
        </table>
        <div class="page-break"></div>
        <table border="1" align="center" cellpadding="5">
            <tr>
                <th colspan="6" align="center">Page {{ 1 + floor(($loop->index + 1) / 5) }} / {{ $tongSoTrang }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Note</th>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</body>

</html>
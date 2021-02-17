@extends('prints.layouts.paper')

@section('title')
Form Product List
@endsection

@section('paper-size') A4 @endsection
@section('paper-class') A4 @endsection

@section('custom-css')
<style>
    .table-avatar {
        width: 100px;
        height: 100px;
    }
</style>
@endsection

@section('content')
<section class="sheet padding-10mm">
    <article>
        <table border="0" align="center">
            <tr>
                <td class="companyInfo" align="center">
                    PHONETN.COM<br />
                    http://phonetn.com/<br />
                    (+123) 123 321 345 # 01.222.888.999<br />
                    <img style="width: 80px;" src="{{ asset('/storage/images/admin/logos/logo1.png') }}" />
                </td>
            </tr>
        </table>
        <br />
        <br />
        <?php 
        $tongSoTrang = ceil(count($products)/5);
        ?>
        <table border="1" align="center" cellpadding="5">
            <caption>Product List</caption>
            <tr>
                <th colspan="6" align="center">Page 1 / {{ $tongSoTrang }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Sku</th>
                <th>Name</th>
                <th>Models</th>
                <th>Supplier</th>
                <th>Image</th>
            </tr>
            @foreach ($products as $sp)
            <tr>
                <td align="center">{{ $loop->index + 1 }}</td>
                <td align="left">{{ $sp->pro_sku }}</td>
                <td align="left">{{ $sp->pro_name }}</td>

                
                @foreach ($models as $model)
                @if ($sp->mod_id == $model->mod_id)
                <td align="left">{{ $model->mod_name }}</td>
                @endif
                @endforeach

                @foreach ($suppliers as $supplier)
                @if ($sp->sup_id == $supplier->sup_id)
                <td align="left">{{ $supplier->sup_name }}</td>
                @endif
                @endforeach

                <td align="center">
                    <img class="table-avatar" src="{{ asset('storage/images/products/' .$sp->models->mod_name.'/'.$sp->pro_image) }}" />
                </td>
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
                <th>Sku</th>
                <th>Name</th>
                <th>Models</th>
                <th>Supplier</th>
                <th>Image</th>
            </tr>
            @endif
            @endforeach
        </table>
    </article>
</section>
@endsection
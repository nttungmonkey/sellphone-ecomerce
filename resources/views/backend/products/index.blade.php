@extends('backend.layouts.master')

@section('title')
Products
@endsection

@section('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .table-avatar {
        display: inline;
        width: 1.5rem;
    }
</style>
@endsection

@section('content-header')
Products
@endsection

@section('content-header-menu')
Products
@endsection

@section('content')
<div class=row>
    <div class="col-12">
        <div class="card">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
                @endforeach
            </div>
            <div class="card-header">
 
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="products">
                    <thead>
                        <tr>
                            <td>Sku</th>
                            <td>Name</th>
                            <td>Image</th>
                            <td>Status</th>
                            <td>Create At</th>
                            <td>Update At</th>
                            <!-- <td style="width:150px;">Action</th> -->
                        </tr>
                    </thead>       
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@section('custom-scripts')
<!-- DataTables -->
<script src="{{ asset('vendor/datatables/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Moments -->
<script src="{{ asset('vendor/momentjs/moment.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var table = $('#products').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.products.getData') }}",
            columns: [
                {data: 'pro_sku', name: 'Sku'},
                {data: 'pro_name', name: 'Name',  orderable: true, searchable: true},
                {   
                    data: 'pro_image', 
                    name: 'Image', 
                    orderable: false, 
                    searchable: false
                },
                {   
                    data: 'pro_status',
                    render: function (data, type, row, meta){
                        if (data == 3){
                            return '<span class="badge badge-danger">Đã bán</span>';
                        }
                        else return '<span class="badge badge-success">Chưa bán</span>';
                    },
                    name: 'Status'},
                    {
                    data: 'pro_created', 
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Created At'
                },
                {
                    data: 'pro_update',
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Updated At'
                }
            ]
        });  
    });
</script>
@endsection


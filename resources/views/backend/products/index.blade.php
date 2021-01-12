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
                <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
                <a href="{{ route('products.print') }}" class="btn btn-primary">Print</a>
                <a href="{{ route('products.excel') }}" class="btn btn-primary">Excel</a>
                <a href="{{ route('products.pdf') }}" class="btn btn-primary">PDF</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="products">
                    <thead>
                        <tr>
                            <td>Name</th>
                            <td>Price</th>
                            <td>Image</th>
                            <td>Infor</th>
                            <td>Review</th>
                            <td>Status</th>
                            <td>Create At</th>
                            <td>Update At</th>
                            <td style="width:150px;">Action</th>
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
        $('body').on('click', '#delete-product', function (e) {
            var sp_ma = $(this).data('id');     
            e.preventDefault();
            var token = $("meta[name='csrf-token']").attr("content");
            if(confirm("Are you sure you want to Delete this data?")){
                $.ajax({
                    type: "POST",
                    url: $(this).attr('name'),
                    data: {
                        id : sp_ma,
                        _token: token,
                        _method: "DELETE"
                    },
                    success: function (data) {
                        location.href = '{{ route('products.index') }}';
                        table.ajax.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }   
                });
            }
            else {
                return false;
            }   
        });
        var table = $('#products').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {data: 'sp_ten', name: 'Name', orderable: true, searchable: true},
                {data: 'sp_giaBan', name: 'Price'},
                {   
                    data: 'image', 
                    name: 'Image', 
                    orderable: false, 
                    searchable: false
                },
                {data: 'sp_thongTin', name: 'Infor'},
                {data: 'sp_danhGia', name: 'Review'},
                {   
                    data: 'sp_trangThai',
                    render: function (data, type, row, meta){
                        if (data == 1){
                            return '<span class="badge badge-danger">Khóa</span>';
                        }
                        else return '<span class="badge badge-success">Khả dụng</span>';
                    },
                    name: 'Status'},
                    {
                    data: 'sp_taoMoi', 
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Created At'
                },
                {
                    data: 'sp_capNhat',
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Updated At'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });  
    });
</script>
@endsection


@extends('backend.layouts.master')

@section('title')
Colors
@endsection

@section('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content-header')
Colors
@endsection

@section('content-header-menu')
Colors
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
                <a href="{{ route('colors.create') }}" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="colors">
                    <thead>
                        <tr>
                            <td>Name</th>
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
{{-- 
<div class="modal fade" id="mdlCategory" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmCategory" action="{{ route('categorys.store') }}" method="POST">
                <input type="hidden" id="action" >
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title" id="CU_Category"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        @include('backend.layouts.partials.error-message')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>                              
                                <input type="text" name="l_ten" id="l_ten" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:</strong>
                                <select name="l_trangThai" class="form-control">    
                                    <option value="1">Khóa</option>
                                    <option value="2">Khả dụng</option>
                                </select>
                            </div>
                        </div>                                          
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveCategory" name="btnsave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>   
            </form> 
        </div>
    </div>
</div>
--}}
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
        $('body').on('click', '#delete-color', function (e) {
            var l_ma = $(this).data('id');     
            e.preventDefault();
            var token = $("meta[name='csrf-token']").attr("content");
            if(confirm("Are you sure you want to Delete this data?")){
                $.ajax({
                    type: "POST",
                    url: $(this).attr('name'),
                    data: {
                        id : l_ma,
                        _token: token,
                        _method: "DELETE"
                    },
                    success: function (data) {
                        location.href = '{{ route('categorys.index') }}';
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
        var table = $('#colors').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('colors.index') }}",
            columns: [
                {data: 'm_ten', name: 'Name', orderable: true, searchable: true},
                {
                    data: 'm_trangThai',
                    render: function (data, type, row, meta){
                        if (data == 1){
                            return '<span class="badge badge-danger">Khóa</span>';
                        }
                        else return '<span class="badge badge-success">Khả dụng</span>';
                    },  
                    name: 'Status'},
                    {
                    data: 'm_taoMoi', 
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Created At'},
                {
                    data: 'm_capNhat',
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


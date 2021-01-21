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
    body {
        padding-right: 0px !important;
    }
    .table-avatar {
        display: inline;
        width: 1.5rem;
    }
    th.dt-header-center, td.dt-center { text-align: center; }
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
            <div class="card-header">
            <a href="javascript:void(0)" id="createProduct" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="products">
                    <thead>
                        <tr>
                            <th>Sku</th>
                            <th>Name</th>                         
                            <th>Model</th>
                            <th>Supplier</th>
                            <th>Image</th> 
                            <th>Status</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>       
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="mdlProduct" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmProduct" action="" method="POST">
                <input type="hidden" id="action" >
                <div class="modal-header">
                    <h4 class="modal-title" id="CU_Product"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        @include('backend.layouts.partials.error-message')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Sku:</strong>                              
                                <input type="text" name="pro_sku" id="pro_sku" class="form-control" placeholder="Sku">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>                              
                                <input type="text" name="pro_name" id="pro_name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Image:</strong>                              
                                <input type="text" name="pro_image" id="pro_image" class="form-control" placeholder="Image">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Detail:</strong>                              
                                <input type="text" name="pro_detail" id="pro_detail" class="form-control" placeholder="Detail">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description Sort:</strong>                              
                                <input type="text" name="pro_descriptS" id="pro_descriptS" class="form-control" placeholder="Description">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description Full:</strong>                              
                                <input type="text" name="pro_descriptF" id="pro_descriptF" class="form-control" placeholder="Description">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Model:</strong>                              
                                <input type="number" name="mod_id" id="mod_id" class="form-control" placeholder="Model">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Supplier:</strong>                              
                                <input type="number" name="sup_id" id="sup_id" class="form-control" placeholder="Supplier">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:</strong>                              
                                <input type="text" name="pro_status" id="pro_status" class="form-control" placeholder="Status">
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:</strong>
                                <select name="l_trangThai" class="form-control">    
                                    <option value="1">Khóa</option>
                                    <option value="2">Khả dụng</option>
                                </select>
                            </div>
                        </div>                                           -->
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveProduct" name="saveProduct" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>   
            </form> 
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
        var pro_id = '';
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var table = $('#products').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.products.index') }}",
            columnDefs: [
            { className: "dt-center", targets: [ 4, 5, 6 ] },
            { className: "dt-header-center", targets: [ 4, 5, 6 ] }
            ],
            columns: [
                {   
                    data: 'pro_sku', 
                    name: 'pro_sku'},
                {
                    data: 'pro_name', 
                    name: 'pro_name',  
                    orderable: true, 
                    searchable: true
                },            
                {
                    data: 'models.mod_name', 
                    name: 'models.mod_name'
                },
                {
                    data: 'supplier.sup_name',
                    name: 'supplier.sup_name'
                },
                {   
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false
                },  
                {   
                    data: 'pro_status',
                    render: function (data, type, row, meta){
                        if (data == 1){
                            return '<span class="badge badge-success">On Sale</span>';
                        }
                        else if(data == 2) {
                            return '<span class="badge badge-info">Shipping</span>';
                            }
                            else if(data == 3) {
                            return '<span class="badge badge-secondary">Sold</span>';
                            }
                            else{
                            return '<span class="badge badge-danger">Lock</span>';
                            }
                    }, 
                    orderable: false, 
                    searchable: false,
                    name: 'pro_status'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });  
        $('#createProduct').click(function () {
            $('#saveProduct').val("create-product");
            $('#frmProduct').trigger("reset");
            $('#CU_Product').html("Create New Product");
            $('#mdlProduct').modal('show');
        });
        $('body').on('click', '.editProduct', function () {
            pro_id = $(this).data('id');
            var url = "{{ route('admin.products.edit', ":pro_id") }}";
            url = url.replace(':pro_id', pro_id);
            $.get(url, function (data) {
                $('#CU_Product').html("Edit Product");
                $('#saveProduct').val("edit-product");
                $('#mdlProduct').modal('show');
                $('#pro_sku').val(data.pro_sku);
                $('#pro_name').val(data.pro_name);
                $('#pro_image').val(data.pro_image);
                $('#pro_detail').val(data.pro_detail);
                $('#pro_descriptS').val(data.pro_descriptS);
                $('#pro_descriptF').val(data.pro_descriptF);
                $('#mod_id').val(data.mod_id);
                $('#sup_id').val(data.sup_id);
                $('#pro_status').val(data.pro_status);
            })
        });
        $('#saveProduct').click(function (e) {
            e.preventDefault();
            var url = '';
            var type = '';
            if($('#saveProduct').val() == 'create-product')
            {
                url = "{{ route('admin.products.store') }}";
                type = "POST";
            }

            if($('#saveProduct').val() == 'edit-product')
            {
                var url = "{{ route('admin.products.update', ":pro_id") }}";
                url = url.replace(':pro_id', pro_id);
                type = "PUT";
            }
            $.ajax({
                data: $('#frmProduct').serialize(),
                url: url,
                type: type,
                dataType: 'json',
                success: function (data) {
                    $('#productForm').trigger("reset");
                    $('#mdlProduct').modal('hide');
                    table.draw();
                    Swal.fire({
                        icon: 'success',
                        title: 'Product saved successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('body').on('click', '.deleteProduct', function () {
            var pro_id = $(this).data("id");
            var url = "{{ route('admin.products.destroy', ":pro_id") }}";
            url = url.replace(':pro_id', pro_id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function (data) {
                                table.draw();
                                Swal.fire(
                                'Deleted!',
                                'Product has been deleted.',
                                'success'
                                )
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });   
                    }
                })
        });
    });
</script>
@endsection


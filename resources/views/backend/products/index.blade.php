@extends('backend.layouts.master')

@section('title')
Products
@endsection

@section('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Bootstrap-fileinput -->
<link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
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
            <a href="{{ route('admin.products.print') }}" class="btn btn-info">Print</a>
            <a href="{{ route('admin.products.excel') }}" class="btn btn-info">Excel</a>
            <a href="{{ route('admin.products.pdf') }}" class="btn btn-info">PDF</a>
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
            <form id="frmProduct" action="" method="POST" enctype="multipart/form-data">
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
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Sku:</strong>                              
                                <input type="text" name="pro_sku" id="pro_sku" class="form-control" placeholder="Sku">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>                              
                                <input type="text" name="pro_name" id="pro_name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Detail:</strong>                              
                                <input type="text" name="pro_detail" id="pro_detail" class="form-control" placeholder="Detail">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Model:</strong>                              
                                <select name="mod_id" id="mod_id" class="form-control" ></select>  
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Supplier:</strong>        
                                <select name="sup_id" id="sup_id" class="form-control" ></select>                      
                            </div>
                        </div>                                                       
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description Sort:</strong>                              
                                <textarea type="text" name="pro_descriptS" id="pro_descriptS" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description Full:</strong>                              
                                <textarea name="pro_descriptF" id="pro_descriptF" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Image:</strong>                              
                                <input type="file" name="pro_image" id="pro_image">
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Related Image:</strong>                              
                                <input type="file" name="pro_reimg[]" id="pro_reimg" multiple>
                            </div>
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
<!-- Bootstrap-fileinput -->
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

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
                            return '<span class="badge badge-info">Lock</span>';
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
            $("#pro_image").fileinput('destroy');
            $("#pro_reimg").fileinput('destroy');
            $('#sup_id').val('').trigger('change');
            $('#mod_id').val('').trigger('change');
            $('#saveProduct').val("create-product");
            $('#frmProduct').trigger("reset");
            $('#CU_Product').html("Create New Product");
            $('#mdlProduct').modal('show');   
            $("#pro_image").fileinput({
                theme: 'fas',
                showUpload: false,
                showCaption: false,
                multiple: true,
                browseClass: "btn btn-primary",
                fileType: "any",
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                overwriteInitial: false
                });
            $("#pro_reimg").fileinput({
                theme: 'fas',
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary",
                fileType: "any",
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                overwriteInitial: false,
                allowedFileExtensions: ["jpg", "gif", "png"]
            });
        });
        $('body').on('click', '.editProduct', function () {
            $("#pro_image").fileinput('destroy');
            pro_id = $(this).data('id');
            var url = "{{ route('admin.products.edit', ":pro_id") }}";
            url = url.replace(':pro_id', pro_id);
            var pro_image;
            $.get(url, function (data) {
                $('#CU_Product').html("Edit Product");
                $('#saveProduct').val("edit-product");
                $('#mdlProduct').modal('show');
                $('#pro_sku').val(data[0].pro_sku);
                $('#pro_name').val(data[0].pro_name);
                pro_image = data[0].pro_image;
                $('#pro_detail').val(data[0].pro_detail);
                $('#pro_descriptS').val(data[0].pro_descriptS);
                $('#pro_descriptF').val(data[0].pro_descriptF);
                $("#mod_id").select2("trigger", "select", {
                    data: { id: data[0].mod_id,
                            text: data[1]
                    }
                });
                $("#sup_id").select2("trigger", "select", {
                    data: { id: data[0].sup_id,
                            text: data[2]
                    }
                });
                $('#pro_status').val(data[0].pro_status);  
                $("#pro_image").fileinput({
                    theme: 'fas',
                    showUpload: false,
                    showCaption: false,
                    browseClass: "btn btn-primary",
                    fileType: "any",
                    append: false,
                    showRemove: false,
                    autoReplace: true,
                    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                    overwriteInitial: false,
                    initialPreviewShowDelete: false,
                    initialPreviewAsData: true,
                    initialPreview: [
                        "{{ asset('storage/images/products/imgs') }}" + '/' + pro_image
                    ],
                    initialPreviewConfig: [
                        {                           
                            width: "120px", 
                            key: 1
                        },
                    ]
                }); 
            });
            $("#pro_reimg").fileinput({
                theme: 'fas',
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary",
                fileType: "any",
                append: false,
                showRemove: false,
                autoReplace: true,
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                overwriteInitial: false,
                allowedFileExtensions: ["jpg", "gif", "png"],
                initialPreviewShowDelete: false,
                initialPreviewAsData: true,
                initialPreview: getReImg(),
                initialPreviewConfig: [
                    {                           
                        width: "120px", 
                        key: 1
                    },
                ]
            });
        });
        $('#saveProduct').click(function (e) {
            e.preventDefault();
            var url = '';
            var formData = new FormData(document.getElementById('frmProduct'));
            if($('#saveProduct').val() == 'create-product')
            {
                url = "{{ route('admin.products.store') }}";
            }

            if($('#saveProduct').val() == 'edit-product')
            {
                var url = "{{ route('admin.products.update', ":pro_id") }}";
                url = url.replace(':pro_id', pro_id);
                formData.append('_method', 'PUT');
            }
            $.ajax({
                data: formData,
                url: url,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#frmProduct').trigger("reset");
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
        $( "#sup_id" ).select2({
                placeholder: '-- Choose Supplier --',
                multiple: false,
                theme: "bootstrap",    
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.getSupplier') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: $.trim(params.term) //search
                        };
                    },
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.sup_name,
                                id: item.sup_id,
                            }
                        })
                    };
                    },
                    cache: false
                }
        });  
        $( "#mod_id" ).select2({
                placeholder: '-- Choose Model --',    
                theme: "bootstrap",  
                multiple: false,   
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.getModels') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: $.trim(params.term) //search
                        };
                    },
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.mod_name,
                                id: item.mod_id,
                            }
                        })
                    };
                    },
                    cache: false
                }    
        }); 
        function getReImg(){
            var files = [];
            var url = "{{ route('admin.products.getReImg', ":pro_id") }}";
            url = url.replace(':pro_id', pro_id);
            $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                success: function (data) {                   
                    $.each(data, function (index, item) {
                        files.push(item.url);                       
                    });
                    console.log(files);                   
                },
                error: function (xhr, status, err) {

                }
            });
            return files;
        } 
    });
</script>
@endsection


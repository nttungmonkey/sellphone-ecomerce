@extends('backend.layouts.master')

@section('title')
Manufactures
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
Manufactures
@endsection

@section('content-header-menu')
Manufactures
@endsection

@section('content')
<div class=row>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            <a href="javascript:void(0)" id="createManufacture" class="btn btn-primary">Create</a>
            <a href="{{ route('admin.manufactures.print') }}" class="btn btn-info">Print</a>
            <a href="{{ route('admin.manufactures.excel') }}" class="btn btn-info">Excel</a>
            <a href="{{ route('admin.manufactures.pdf') }}" class="btn btn-info">PDF</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="manufactures">
                    <thead>
                        <tr>
                            <th>Name</th>                                                 
                            <th>Created At</th>
                            <th>Update At</th> 
                            <th>Logo</th>
                            <th>Status</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>       
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="mdlManufacture" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmManufacture" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="action" >
                <div class="modal-header">
                    <h4 class="modal-title" id="CU_Manufacturer"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">               
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="alert alert-danger print-error-msg" style="display: none;" role="alert">
                                <ul></ul>
                           </div> 
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>                              
                                <input type="text" name="mnf_name" id="mnf_name" class="form-control" placeholder="Name">
                            </div>
                        </div>   
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Status:</strong>                              
                                <select name="mnf_status" id="mnf_status" class="form-control" >
                                    <option></option>
                                    <option value="1">Available</option>
                                    <option value="2">Lock</option>
                                </select>   
                            </div>
                        </div>                                                                         
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Logo:</strong>                              
                                <input type="file" name="mnf_logo" id="mnf_logo">
                            </div>
                        </div>                                                              
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveManufacture" name="saveManufacture" class="btn btn-primary">Save</button>
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
        var mnf_id = '';
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var table = $('#manufactures').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.manufactures.index') }}",
            columnDefs: [
            { className: "dt-center", targets: [ 3, 4, 5 ] },
            { className: "dt-header-center", targets: [ 3, 4, 5 ] }
            ],
            columns: [           
                {
                    data: 'mnf_name', 
                    name: 'mnf_name',  
                    orderable: true, 
                    searchable: true
                },
                {
                    data: 'mnf_created', 
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Created At'
                },  
                {
                    data: 'mnf_updated',
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Updated At'
                },                                  
                {   
                    data: 'image', 
                    name: 'image', 
                    orderable: false, 
                    searchable: false
                },  
                {   
                    data: 'mnf_status',
                    render: function (data, type, row, meta){
                        if (data == 1){
                            return '<span class="badge badge-success">Available</span>';
                        }
                        else if(data == 2) {
                            return '<span class="badge badge-info">Lock</span>';
                            }
                    }, 
                    orderable: false, 
                    searchable: false,
                    name: 'mnf_status'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });  
        $('#createManufacture').click(function () {
            $("#mnf_logo").fileinput('destroy');
            $('#mnf_status').val('').trigger('change');
            $('#saveManufacture').val("create-manufacture");
            $('#frmManufacture').trigger("reset");
            $('#CU_Manufacturer').html("Create Manufacture");
            $('#mdlManufacture').modal('show');   
            deleteErrorMsg();
            $("#mnf_logo").fileinput({
                theme: 'fas',
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary",
                fileType: "any",
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                overwriteInitial: false
                });
        });
        $('body').on('click', '.editManufacture', function () {
            $("#mnf_logo").fileinput('destroy');
            mnf_id = $(this).data('id');
            var url = "{{ route('admin.manufactures.edit', ":mnf_id") }}";
            url = url.replace(':mnf_id', mnf_id);
            var mnf_logo;
            $.get(url, function (data) {
                $('#CU_Manufacturer').html("Edit Manufacture");
                $('#saveManufacture').val("edit-manufacture");
                $('#mdlManufacture').modal('show');
                deleteErrorMsg();
                $('#mnf_name').val(data.mnf_name);
                $("#mnf_status").val(data.mnf_status).trigger('change');
                mnf_logo = data.mnf_logo;
                $("#mnf_logo").fileinput({
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
                        "{{ asset('storage/images/manufactures/') }}" + '/' + mnf_logo
                    ],
                    initialPreviewConfig: [
                        {                           
                            width: "50px", 
                            height: "50px",
                            key: 1
                        },
                    ]
                }); 
            });
        });
        $('#saveManufacture').click(function (e) {
            e.preventDefault();
            var url = '';
            var formData = new FormData(document.getElementById('frmManufacture'));
            if($('#saveManufacture').val() == 'create-manufacture')
            {
                url = "{{ route('admin.manufactures.store') }}";
            }

            if($('#saveManufacture').val() == 'edit-manufacture')
            {
                var url = "{{ route('admin.manufactures.update', ":mnf_id") }}";
                url = url.replace(':mnf_id', mnf_id);
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
                    if($.isEmptyObject(data.error)){
                        $('#frmManufacture').trigger("reset");
                        $('#mdlManufacture').modal('hide');
                        table.draw();
                        Swal.fire({
                            icon: 'success',
                            title: 'Manufacture saved successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }else{
                        printErrorMsg(data.error);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('body').on('click', '.deleteManufacture', function () {
            var mnf_id = $(this).data("id");
            var url = "{{ route('admin.manufactures.destroy', ":mnf_id") }}";
            url = url.replace(':mnf_id', mnf_id);
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
                                'Manufacture has been deleted.',
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
        $( "#mnf_status" ).select2({
                placeholder: '-- Choose Status --',    
                theme: "bootstrap",  
                multiple: false,   
                allowClear: true,
                minimumResultsForSearch: Infinity               
        });   
        function printErrorMsg(msg){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        function deleteErrorMsg(){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','none');
        }        
    });
</script>
@endsection


@extends('backend.layouts.master')

@section('title')
Suppliers
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
Suppliers
@endsection

@section('content-header-menu')
Suppliers
@endsection

@section('content')
<div class=row>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            <a href="javascript:void(0)" id="createSupplier" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="supplier">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>                         
                            <th>Email</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>       
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="mdlSupplier" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmSupplier" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="action" >
                <div class="modal-header">
                    <h4 class="modal-title" id="CU_Supplier"></h4>
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
                                <input type="text" name="sup_name" id="sup_name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Phone:</strong>                              
                                <input type="text" name="sup_phonenum" id="sup_phonenum" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>                              
                                <input type="text" name="sup_email" id="sup_email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Note:</strong>                              
                                <textarea type="text" name="sup_note" id="sup_note" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Address:</strong>        
                                <select name="adr_id" id="adr_id" class="form-control" ></select>                      
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Status:</strong>        
                                <select name="sup_status" id="sup_status" class="form-control" >
                                    <option></option>
                                    <option value="1">Available</option>
                                    <option value="2">Lock</option>
                                </select>                      
                            </div>
                        </div>                                                                                                          
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveSupplier" name="saveSupplier" class="btn btn-primary">Save</button>
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
        var sup_id = '';
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var table = $('#supplier').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.suppliers.index') }}",
            columnDefs: [
            { className: "dt-center", targets: [ 5, 6 ] },
            { className: "dt-header-center", targets: [ 5, 6 ] }
            ],
            columns: [
                {   
                    data: 'sup_name', 
                    name: 'sup_name',
                    orderable: true, 
                    searchable: true
                },             
                {
                    data: 'sup_phonenum', 
                    name: 'sup_phonenum',  
                    orderable: true, 
                    searchable: true
                },
                {
                    data: 'sup_email', 
                    name: 'sup_email',  
                    orderable: true, 
                    searchable: true
                }, 
                {
                    data: 'address.adr_address', 
                    name: 'address.adr_address',  
                    orderable: true, 
                    searchable: true
                },   
                            
                {   
                    data: 'sup_note', 
                    name: 'sup_note', 
                    orderable: false, 
                    searchable: false
                },  
                {   
                    data: 'sup_status',
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
                    name: 'sup_status'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });  
        $('#createSupplier').click(function () {
            $('#adr_id').val('').trigger('change');
            $('#sup_status').val('').trigger('change');
            $('#saveSupplier').val("create-supplier");
            $('#frmSupplier').trigger("reset");
            $('#CU_Supplier').html("Create New Supplier");
            $('#mdlSupplier').modal('show');   
        });
        $('body').on('click', '.editSupplier', function () {
            sup_id = $(this).data('id');
            var url = "{{ route('admin.suppliers.edit', ":sup_id") }}";
            url = url.replace(':sup_id', sup_id);
            $.get(url, function (data) {
                $('#CU_Supplier').html("Edit Supplier");
                $('#saveSupplier').val("edit-supplier");
                $('#mdlSupplier').modal('show');
                $('#sup_name').val(data[0].sup_name);
                $('#sup_phonenum').val(data[0].sup_phonenum);
                $('#sup_email').val(data[0].sup_email);
                $('#sup_note').val(data[0].sup_note);
                $("#adr_id").select2("trigger", "select", {
                    data: { id: data[0].adr_id,
                            text: data[1]
                    }
                });
                $("#sup_status").val(data[0].sup_status).trigger('change');                
            });
            
        });
        $('#saveSupplier').click(function (e) {
            e.preventDefault();
            var url = '';
            var formData = new FormData(document.getElementById('frmSupplier'));
            if($('#saveSupplier').val() == 'create-supplier')
            {
                url = "{{ route('admin.suppliers.store') }}";
            }

            if($('#saveSupplier').val() == 'edit-supplier')
            {
                var url = "{{ route('admin.suppliers.update', ":sup_id") }}";
                url = url.replace(':sup_id', sup_id);
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
                    $('#frmSupplier').trigger("reset");
                    $('#mdlSupplier').modal('hide');
                    table.draw();
                    Swal.fire({
                        icon: 'success',
                        title: 'Supplier saved successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('body').on('click', '.deleteSupplier', function () {
            var sup_id = $(this).data("id");
            var url = "{{ route('admin.suppliers.destroy', ":sup_id") }}";
            url = url.replace(':sup_id', sup_id);
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
                                'Supplier has been deleted.',
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
        $( "#adr_id" ).select2({
                placeholder: '-- Choose Address --',
                multiple: false,
                theme: "bootstrap",    
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.getAddress') }}",
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
                                text: item.adr_address,
                                id: item.adr_id,
                            }
                        })
                    };
                    },
                    cache: false
                }
        });
        $( "#sup_status" ).select2({
                placeholder: '-- Choose Status --',    
                theme: "bootstrap",  
                multiple: false,   
                allowClear: true,
                minimumResultsForSearch: Infinity               
        });     
    });
</script>
@endsection


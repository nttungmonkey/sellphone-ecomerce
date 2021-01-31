@extends('backend.layouts.master')

@section('title')
Models
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
Models
@endsection

@section('content-header-menu')
Models
@endsection

@section('content')
<div class=row>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            <a href="javascript:void(0)" id="createModel" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="models">
                    <thead>
                        <tr>
                            <th>Name</th> 
                            <th>Manufacture</th>
                            <th>Note</th>                                                
                            <th>Created At</th>
                            <th>Update At</th>                          
                            <th>Status</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>       
                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="mdlModel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmModel" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="action" >
                <div class="modal-header">
                    <h4 class="modal-title" id="CU_Model"></h4>
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
                                <input type="text" name="mod_name" id="mod_name" class="form-control" placeholder="Name">
                            </div>
                        </div>   
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Status:</strong>                              
                                <select name="mod_status" id="mod_status" class="form-control" >
                                    <option></option>
                                    <option value="1">Available</option>
                                    <option value="2">Lock</option>
                                </select>   
                            </div>
                        </div> 
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Manufacture:</strong>        
                                <select name="mnf_id" id="mnf_id" class="form-control" ></select>                      
                            </div>
                        </div>                                                                         
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Note:</strong>                              
                                <textarea type="text" name="mod_note" id="mod_note" class="form-control"></textarea>
                            </div>
                        </div>                                                            
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveModel" name="saveModel" class="btn btn-primary">Save</button>
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
        var mod_id = '';
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var table = $('#models').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.models.index') }}",
            columnDefs: [
            { className: "dt-center", targets: [ 5, 6 ] },
            { className: "dt-header-center", targets: [ 5, 6 ] }
            ],
            columns: [           
                {
                    data: 'mod_name', 
                    name: 'mod_name',  
                    orderable: true, 
                    searchable: true
                },
                {
                    data: 'manufacture.mnf_name',
                    name: 'manufacture.mnf_name'
                },
                {
                    data: 'mod_note', 
                    name: 'mod_note',  
                    orderable: false, 
                    searchable: false
                },
                {
                    data: 'mod_created', 
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Created At'
                },  
                {
                    data: 'mod_updated',
                    render: function (data, type, row, meta){
                        return moment(data).format('DD/MM/YYYY hh:mm:ss');
                    }, 
                    name: 'Updated At'
                },                                                  
                {   
                    data: 'mod_status',
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
                    name: 'mod_status'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });  
        $('#createModel').click(function () {
            $('#mod_status').val('').trigger('change');
            $('#mnf_id').val('').trigger('change');
            $('#saveModel').val("create-model");
            $('#frmModel').trigger("reset");
            $('#CU_Model').html("Create Model");
            $('#mdlModel').modal('show');
        });
        $('body').on('click', '.editModel', function () {
            mod_id = $(this).data('id');
            var url = "{{ route('admin.models.edit', ":mod_id") }}";
            url = url.replace(':mod_id', mod_id);
            $.get(url, function (data) {
                $('#CU_Model').html("Edit Model");
                $('#saveModel').val("edit-model");
                $('#mdlModel').modal('show');
                $('#mod_name').val(data[0].mod_name);
                $("#mod_status").val(data[0].mod_status).trigger('change');
                $('#mod_note').val(data[0].mod_note);
                $("#mnf_id").select2("trigger", "select", {
                    data: { id: data[0].mnf_id,
                            text: data[1]
                    },
                    closeOnSelect: true
                });                 
            });
        });
        $('#saveModel').click(function (e) {
            e.preventDefault();
            var url = '';
            var formData = new FormData(document.getElementById('frmModel'));
            if($('#saveModel').val() == 'create-model')
            {
                url = "{{ route('admin.models.store') }}";
            }

            if($('#saveModel').val() == 'edit-model')
            {
                var url = "{{ route('admin.models.update', ":mod_id") }}";
                url = url.replace(':mod_id', mod_id);
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
                    $('#frmModel').trigger("reset");
                    $('#mdlModel').modal('hide');
                    table.draw();
                    Swal.fire({
                        icon: 'success',
                        title: 'Model saved successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('body').on('click', '.deleteModel', function () {
            var mod_id = $(this).data("id");
            var url = "{{ route('admin.models.destroy', ":mod_id") }}";
            url = url.replace(':mod_id', mod_id);
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
                                'Model has been deleted.',
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
        $( "#mod_status" ).select2({
                placeholder: '-- Choose Status --',    
                theme: "bootstrap",  
                multiple: false,   
                allowClear: true,
                minimumResultsForSearch: Infinity,
                closeOnSelect: true         
        });
        $( "#mnf_id" ).select2({
                placeholder: '-- Choose Manufacture --',    
                theme: "bootstrap",  
                multiple: false,   
                allowClear: true,
                closeOnSelect: true,
                ajax: {
                    url: "{{ route('admin.getManufacture') }}",
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
                                text: item.mnf_name,
                                id: item.mnf_id,
                            }
                        })
                    };
                    },
                    cache: false
                }    
        });    
    });
</script>
@endsection


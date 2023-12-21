@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default{
        width: 450px !important;
    }
</style>
<br>
<br>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Center List</h4>
            
            <div class="card-tools">
<!--                <a href="{{url('admin/centers/create')}}" class="btn btn-info btn-sm" >
                    <i class="fas fa-plus-circle"></i> Add New Center-->
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add New Center
                </button>
                    
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $row)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $row->center_name }}
                            </td>

                            <td>
                                {{ $row->center_value }}
                            </td>
                            
                            <td>
                               @if(Auth::user()->can('add-center'))
                               <div class="row">
                                <button type="button" data-id="{{$row->id}}" class="btn btn-default edit_modal" data-toggle="modal" data-target="#edit-modal">
                  Edit
                </button>
                                @endif
                                @if(Auth::user()->can('delete-center'))
                                <form method="post" action="{{url('admin/centers/'.$row->id)}}" style="margin-left: 10px;margin-top: 4px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick='return confirmItem()' class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                                <div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Modal-->
    
      <div class="modal fade" id="add-modal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Center</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form id="add_form">
            <div class="modal-body">
                
                <div class="success_msg"></div>
            
          
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="Name">
                            Center Name
                        </label>
                        <input type="text" class="form-control" name="center_name" id="center_name" placeholder="Center name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Center Value </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="number" class="form-control" name="center_value" id="center_value" placeholder="Center value">
                            </div>
                        </div>
                    </div>

                </div>

           
        
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
                     </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
          <!--Edit Modal-->
    
      <div class="modal fade" id="edit-modal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Center</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form id="edit_form">
                    @method('PUT')
                    <div class="modal-body" id="edit_modal_body">
             
        
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
                     </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    
</div>

<script>
        $("#add_form").submit(function (e){
        e.preventDefault();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/centers")}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                
            }
        }).done(function() {
            $(".success_msg").html("Data Save Successfully");
            $(".success_msg").show();
            setInterval(function() {
                window.location.href = "{{ url('admin/centers')}}";
            }, 1000);
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                console.log(key);
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
    });
    
//    Edit 
    $(".edit_modal").click(function (){

        var id = $(this).data("id");
        $.ajax({
            method: "GET",
            url: "centers/"+id+"/edit",
            data: id,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                $("#edit_modal_body").html(data);
                $("#edit_modal").modal("show");
                
            }
        });
    });
    
//    Update

        $("#edit_form").submit(function (e){
            e.preventDefault();
            //alert('sdfas');
        $(".error_msg").html('');

        var data = new FormData($('#edit_form')[0]);
    
        var id = $('[name=id]').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "centers/"+id,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                
            }
        }).done(function() {
            $(".success_msg").html("Data Save Successfully");
            location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
    });
</script>


@endsection



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
            <h4 class="card-title">List</h4>
            
            <div class="card-tools">
<!--                <a href="{{url('admin/genere/create')}}" class="btn btn-info btn-sm" >
                    <i class="fas fa-plus-circle"></i> Add New Genere-->
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add New Genere
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
                        <th>Description</th>
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
                                {{ $row->genere_name }}
                            </td>

                            <td>
                                {{ $row->genere_description }}
                            </td>
                            
                            <td>
                               {{-- @if(Auth::user()->can('add-genere')) --}}
                               <div class="row">
                                <button type="button" data-id="{{$row->id}}" class="btn btn-default edit_modal" data-toggle="modal" data-target="#edit-modal">
                  Edit
                </button>
                                {{-- @endif --}}
                                {{-- @if(Auth::user()->can('delete-genere')) --}}
                                <form method="post" action="{{url('admin/genere/'.$row->id)}}" style="margin-left: 10px;margin-top: 4px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick='return confirmItem()' class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                {{-- @endif --}}
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
              <h4 class="modal-title">Add New Genere</h4>
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
                            Genere Name
                        </label>
                        <input type="text" class="form-control" name="genere_name" id="genere_name" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Name"> Genere Description </label>
                        <div class="optionBox">
                            <div class="block">
                                <input type="text" class="form-control" name="genere_description" id="genere_description" placeholder="">
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
              <h4 class="modal-title">Edit Genere</h4>
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
            $(this).find("button[type='submit']").prop('disabled',true);
            $('.loader').show();
        e.preventDefault();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/genere")}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                
            }
        }).done(function() {
            $('.loader').hide();
            $(".success_msg").html("Data Save Successfully");
            $(".success_msg").show();
            setInterval(function() {
                window.location.href = "{{ url('admin/genere')}}";
            }, 1000);
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            $('.loader').hide();
            $(this).find("button[type='submit']").prop('disabled',false);
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                console.log(key);
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
    });
    
//    Edit 
    $(".edit_modal").click(function (){
        $('.loader').show();
        var id = $(this).data("id");
        $.ajax({
            method: "GET",
            url: "genere/"+id+"/edit",
            data: id,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                $('.loader').hide();
                $("#edit_modal_body").html(data);
                $("#edit_modal").modal("show");
                
            }
        });
    });
    
//    Update

        $("#edit_form").submit(function (e){
            e.preventDefault();
            $('.loader').show();
            $(this).find("button[type='submit']").prop('disabled',true);
            //alert('sdfas');
        $(".error_msg").html('');

        var data = new FormData($('#edit_form')[0]);
    
        var id = $('[name=id]').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "genere/"+id,
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
            $('.loader').hide();
            $(this).find("button[type='submit']").prop('disabled',false);
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
    });
</script>


@endsection



@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default{
        width: 450px !important;
    }
</style>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Frequently asked questions list</h4>

            <div class="card-tools">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add New
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Question</th>
                        <th>Answer</th>
                        {{--<th>Action</th>--}}
                    </tr>
                </thead>
                <tbody>
                   @foreach($list as $row)
                       <tr>
                           <td>
                               {{ $loop->iteration }}
                           </td>

                           <td>
                               {{ $row->question  }}
                           </td>
                           <td>
                               {{ $row->answer }}
                           </td>


                           <td>
                           {{-- <a class="btn btn-success btn-sm" href="{{url('admin/authors')}}/{{ $row->id }}/edit">
                           Edit
                           </a> --}}
                           {{-- <a class="btn btn-danger btn-sm text-white">
                           Delete
                           </a> --}}
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
              <h4 class="modal-title">Add Frequently asked questions</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form id="add_form">
            <div class="modal-body">

                <div class="success_msg"></div>


                <div class="form-row">

                    <div class='col-6'>
            <div class="form-group">
              <label for="text-area">Question </label>
              <input type="text" name="question" id="name" placeholder="Question" class="form-control">
            </div>
            </div>
                    <div class='col-6'>
            <div class="form-group">
              <label for="text-area">Answer </label>
              <input type="text" name="answer" id="last_name" placeholder="Answer" class="form-control">
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


</div>

<script>
        $("#add_form").submit(function (e){
        e.preventDefault();
        $('.loader').show();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/frequent-questions")}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
                if(data=='emailUsed'){
                     $('#add-modal').modal('show')
                    $('#emailerror').html('This mail already used choose another');
                     return false;
                }
                $('#emailerror').html('');
                $(".success_msg").html("Data Save Successfully");
                $(".success_msg").show();
                location.reload();
            }
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
//                console.log(key);
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        $('.loader').hide();
    });


</script>
@endsection

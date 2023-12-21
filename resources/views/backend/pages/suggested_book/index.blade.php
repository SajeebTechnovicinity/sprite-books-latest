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
            <h4 class="card-title">Suggested Books List</h4>

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
                        <th>Name {{count($list)}}</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Hardbook Price</th>
                        <th>Ebook Price</th>
                        <th>Discount</th>
                        <th>Added</th>
                        {{--<th>Action</th>--}}
                    </tr>
                </thead>
                @if($list->isNotEmpty())
                
                <tbody>
                   @foreach($list as $row)
                       <tr>
                           <td>
                               {{ $loop->iteration }}
                           </td>

                           <td>
                               {{ $row->Book->book_name  }}
                           </td>
                           <td>
                               {{ $row->Book->bookAuthor->author_name }}
                           </td>
                           <td>
                               {{ $row->Book->book_description }}
                           </td>
                           <td>
                           <img height="60px" width="60px" src="{{asset($row->Book->bookDocuments[0]->path)}}">
                        </td>
                           <td>
                               {{ $row->Book->book_price  }}
                           </td>
                           <td>
                               {{ $row->Book->hard_book_price }}
                           </td>
                           <td>
                               {{ $row->Book->ebook_price }}
                           </td>
                           <td>
                            {{ $row->Book->book_discount_in_percentage }}%
                        </td>
                        <td>
                            {{ $row->Book->created_at }}
                        </td>
                           
                           <td>
                           {{-- <a class="btn btn-success btn-sm" href="{{url('admin/authors')}}/{{ $row->Book->id }}/edit">
                           Edit
                           </a> --}}
                           {{-- <a class="btn btn-danger btn-sm text-white">
                           Delete
                           </a> --}}
                           </td>
                       </tr>
                   @endforeach


                </tbody>
                @endif
            </table>
        </div>
    </div>


    <!-- Add Modal-->

      <div class="modal fade" id="add-modal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New</h4>
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
                          <label for="text-area">Select Author </label>
                          <select name="author_id" id="author_id" class="form-control">
                            @foreach ($authors as $author)      
                              <option value="{{$author->id}}">{{$author->author_name}}</option>
                              @endforeach
                          </select>
                        </div>
                        </div>

                        
                    <div class='col-6'>
                        <div class="form-group">
                          <label for="text-area">Select Genere </label>
                          <select name="genere_id" id="genere_id" class="form-control">
                           
                          </select>
                        </div>
                        </div>

                    <div class='col-6'>
            <div class="form-group">
              <label for="text-area">Book </label>
              <select name="book_id" id="book_id" class="form-control">
              
              </select>
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
            url: "{{url("admin/suggested-books")}}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data, textStatus, jqXHR) {
               
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

    $('#author_id').change(function() {
        $('.loader').show();
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/get-author-generes-by-author-id")}}",
            data: {id:$(this).val()},           
            success: function (data, textStatus, jqXHR) {
               $('#genere_id').html(data);
               
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

$('#genere_id').change(function() {
        $('.loader').show();
       
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            method: "POST",
            url: "{{url("admin/get-author-books-by-genere-id")}}",
            data: {id:$(this).val(),author_id:$('#author_id').val()},           
            success: function (data, textStatus, jqXHR) {
               $('#book_id').html(data);
               
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

@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }
    </style>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Book List</h4>

                {{-- <div class="card-tools">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add Author
                </button>
            </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Hardbook Price</th>
                            <th>Ebook Price</th>
                            <th>Discount</th>
                            <th>Added</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $row->book_name }}
                                </td>
                                <td>
                                    {{ $row->bookAuthor->author_name }}
                                </td>
                                <td>
                                    {{ $row->book_description }}
                                </td>
                                <td>
                                    @if (isset($row->bookDocuments[0]))
                                        <img height="60px" width="60px" src="{{ asset($row->bookDocuments[0]->path) }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $row->book_price }}
                                </td>
                                <td>
                                    {{ $row->hard_book_price }}
                                </td>
                                <td>
                                    {{ $row->ebook_price }}
                                </td>
                                <td>
                                    {{ $row->book_discount_in_percentage }}%
                                </td>
                                <td>
                                    {{ $row->created_at }}
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


    </div>

    <script>
        $("#add_form").submit(function(e) {
            e.preventDefault();
            $('.loader').show();
            $(".error_msg").html('');
            var data = new FormData($('#add_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('admin/authors') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    if (data == 'emailUsed') {
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
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });
            $('.loader').hide();
        });
    </script>
@endsection

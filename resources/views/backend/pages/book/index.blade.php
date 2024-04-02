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

                <div class="card-tools">
                              <a type="button" href="{{ url('/admin/book/create') }}" class="btn btn-default">Add Book</a>
        
            </div>
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
                            <th>Action</th>
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
                                    @if ($row->bookAuthor)
                                        {{ $row->bookAuthor->author_name }}
                                    @endif
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
                                    <a class="btn btn-success btn-sm" href="{{url('admin/books')}}/{{ $row->id }}/edit">
                           Edit
                           </a>
                                    <a class="btn btn-danger btn-sm text-white"
                                        onclick="confirmCancellation(event,{{ $row->id }})">
                                        Delete
                                    </a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmCancellation(event, id) {
            event.preventDefault(); // Prevent the default action of the link
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," proceed with the cancellation
                    window.location.href = "{{ url('book/delete/') }}" + "/" + id;
                }
            });
        }
    </script>
@endsection

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
                <h4 class="card-title">Community List</h4>

                {{-- <div class="card-tools">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add Author
                </button>
            </div> --}}

                <a class="btn btn-default" style="float:right;" href="{{ url('admin/create-community') }}">
                    Create
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Creator</th>
                            <th>Date of Creator</th>
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
                                    @if (isset($row->community_cover_image))
                                        <img height="60px" width="60px" src="{{ asset($row->community_cover_image) }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $row->community_name }}
                                </td>
                                <td>
                                    {{ $row->community_description }}
                                </td>
                                <td>
                                    @if ($row->communityAuthor)
                                        {{ $row->communityAuthor->author_name }}
                                        {{ $row->communityAuthor->author_last_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $row->created_at }}
                                </td>

                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ url('admin/edit-community') }}/{{ $row->id }}">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm text-white"
                                        onclick="confirmCancellation(event,{{ $row->id }})">
                                        Delete
                                    </a>
                                     <a class="btn btn-success btn-sm"
                                        href="{{ url('admin/community/post') }}/{{ $row->id }}">
                                        All Post
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
                    window.location.href = "{{ url('/admin/delete-community/') }}" + "/" + id;
                }
            });
        }
    </script>
@endsection

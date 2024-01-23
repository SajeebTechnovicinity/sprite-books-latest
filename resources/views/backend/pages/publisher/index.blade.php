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
                <h4 class="card-title">Publisher List</h4>

                {{-- <div class="card-tools">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                  Add Publisher
                </button>
            </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Membership Plan</th>
                            <th>Subscribe Expire Time</th>
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
                                    {{ $row->author_code }}
                                </td>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ $row->author_name }}
                                </td>
                                <td>
                                    {{ $row->author_last_name }}
                                </td>
                                <td>
                                    {{ $row->author_email }}
                                </td>
                                <td>
                                    {{ $row->author_phone }}
                                </td>
                                <td>
                                    {{ $row->author_country }}
                                </td>
                                <td>
                                    @if ($row->userMembershipPlan)
                                        {{ $row->userMembershipPlan->MembershipPlan->membership_plan_name }}
                                        ({{ $row->userMembershipPlan->duration }})
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($row->subscription)
                                        {{ date('Y-m-d H:i:s', $row->subscription->ends_at) }}
                                    @else
                                        N/A
                                    @endif
                                </td>


                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ url('admin/authors') }}/{{ $row->id }}/edit">
                                        Edit
                                    </a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ url('admin/user/support') }}/{{ $row->id }}" target="_blank">
                                        Login
                                    </a>
                                    <a class="btn btn-danger btn-sm text-white"
                                        href="{{ url('admin/app/user/delete') }}/{{ $row->id }}"
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


        <!-- Add Modal-->

        <div class="modal fade" id="add-modal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Publisher</h4>
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
                                        <label for="text-area">Email </label>
                                        <input type="email" name="email" id="email" placeholder="Email"
                                            class="form-control">
                                        <h6 id="emailerror" style="color:#dc2e2e"></h6>
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class="form-group">
                                        <label for="text-area">Name </label>
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class="form-group">
                                        <label for="text-area">Last Name </label>
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- <div class='col-6'>
                <div class="form-group">
            <label for="identity_no">Identification Number</label>
            <input type="text" class="form-control" name="identity_no" id="identity_no" placeholder="Suite:28912">
          </div>
          </div> --}}
                                <div class='col-6'>
                                    <div class="form-group">
                                        <label for="text-area">Country </label>
                                        <select name="country" id="country" class="form-control">
                                            @foreach ($country_list as $list)
                                                <option>{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class="form-group">
                                        <label for="text-area">Phone </label>
                                        <input type="text" name="phone" id="phone" placeholder="Phone"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class="form-group">
                                        <label for="text-area">Password </label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="**********">
                                        <p>Use only letters and numbers for the password</p>
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
                url: "{{ url('admin/publishers') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $('.loader').hide();
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
                $('.loader').hide();
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    //                console.log(key);
                    $("[name='" + key + "']").after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });

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
                    window.location.href = "{{ url('admin/app/user/delete/') }}" + "/" + id;
                }
            });
        }
    </script>
@endsection

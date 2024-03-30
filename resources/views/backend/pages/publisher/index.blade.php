@extends('layouts.backend.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<style>
    span.select2.select2-container.select2-container--default {
        width: 450px !important;
    }

    .table-des .figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .table-des .figure {
        height: 70px;
        width: 70px;
        overflow: hidden;
        border-radius: 50%;
    }

    .table-des .sbs span,
    .table-des .info span {
        display: block;
    }

    .table-des .info span i {
        color: #777777;
        font-size: 70%;
        margin-right: 5px;
    }

</style>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Publisher List</h4>

            <div class="card-tools">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                    Add Publisher
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped table-des">
                <thead>

                    <tr>
                        <th>Select All <br> <input type="checkbox" id="select-all"></th>
                        <th>Sl</th>

                    <tr>

                        <th>Code</th>
                        <th>Profile</th>
                        <th>Contact Information</th>
                        <th>Membership</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $row)

                    <tr>
                        <td><input type="checkbox" class="checkbox" value="{{ $row->id }}"></td>

                    <tr>
                        <td>{{ $row->author_code }}</td>

                        <td>
                            <div class="figure">
                                <img src="https://coenterprises.com.au/wp-content/uploads/2018/02/male-placeholder-image.jpeg" alt="">
                            </div>
                        </td>

                        <td>
                            <div class="info">
                                <span><i class="fas fa-regular fa-copy"></i> {{ $row->author_name }} {{ $row->author_last_name }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> {{ $row->author_email }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> {{ $row->author_phone }}</span>
                                <span><i class="fas fa-regular fa-copy"></i> {{ $row->author_country }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="sbs">
                                <span>Membership Plan:
                                    @if ($row->userMembershipPlan)
                                    {{ $row->userMembershipPlan->MembershipPlan->membership_plan_name }}
                                    ({{ $row->userMembershipPlan->duration }})
                                    @else
                                    N/A
                                    @endif
                                </span>
                                <span>Subscribe Expire Time:
                                    @if ($row->subscription)
                                    {{ date('Y-m-d H:i:s', $row->subscription->ends_at) }}
                                    @else
                                    N/A
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ url('admin/authors') }}/{{ $row->id }}/edit">
                                Edit
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/user/support') }}/{{ $row->id }}" target="_blank">
                                Login
                            </a>
                            <a class="btn btn-danger btn-sm text-white" onclick="confirmCancellation(event,{{ $row->id }})">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <button type="button" class="btn btn-danger" id="delete-selected">Delete Selected</button>

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
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                    <h6 id="emailerror" style="color:#dc2e2e"></h6>
                                </div>
                            </div>
                            <div class='col-6'>
                                <div class="form-group">
                                    <label for="text-area">Name </label>
                                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class='col-6'>
                                <div class="form-group">
                                    <label for="text-area">Last Name </label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
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
                                    <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
                                </div>
                            </div>
                            <div class='col-6'>
                                <div class="form-group">
                                    <label for="text-area">Membership Plan </label>
                                    <select name="membership_plan" id="membership_plan" class="form-control">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                        <option value="Life Time">Life Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class='col-6'>
                                <div class="form-group">
                                    <label for="text-area">Password </label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="**********">
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
            }
            , method: "POST"
            , url: "{{ url('admin/publishers') }}"
            , data: data
            , cache: false
            , contentType: false
            , processData: false
            , success: function(data, textStatus, jqXHR) {
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
            title: 'Are you sure?'
            , text: 'You won\'t be able to revert this!'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes," proceed with the cancellation
                window.location.href = "{{ url('admin/app/user/delete/') }}" + "/" + id;
            }
        });
    }

</script>

<script>
    $(document).ready(function() {
        // Select/deselect all checkboxes
        $('#select-all').click(function() {
            $('.checkbox').prop('checked', this.checked);
        });

        // Handle multiple deletion
        $('#delete-selected').click(function() {
            var selectedIds = [];

            $('.checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                confirmMultipleDeletion(selectedIds);
            } else {
                alert('Please select at least one item to delete.');
            }
        });

        function confirmMultipleDeletion(selectedIds) {
            Swal.fire({
                title: 'Are you sure?'
                , text: 'You won\'t be able to revert this!'
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes," proceed with the deletion
                    deleteSelectedItems(selectedIds);
                }
            });
        }

        function deleteSelectedItems(selectedIds) {
            // Create a form element dynamically
            var form = document.createElement('form');
            form.setAttribute('method', 'POST'); // Change the method to GET
            form.setAttribute('action', "{{ url('/admin/user/delete-selected') }}");

            // Create a hidden input field for CSRF token
            var csrfTokenInput = document.createElement('input');
            csrfTokenInput.setAttribute('type', 'hidden');
            csrfTokenInput.setAttribute('name', '_token');
            csrfTokenInput.setAttribute('value', $('meta[name="csrf-token"]').attr('content'));
            form.appendChild(csrfTokenInput);

            // Create a hidden input field for each selected ID
            selectedIds.forEach(function(id) {
                var input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'ids[]');
                input.setAttribute('value', id);
                form.appendChild(input);
            });

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();
        }
    });

</script>
@endsection

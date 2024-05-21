@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }
    </style>
    <br>
    <a href="{{ url()->previous() }}" style="float:right;" class="btn btn-primary">Back</a>
    <br>
    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Membership Plan Info</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id="add_form" enctype="multipart/form-data">
                    <div class="form-row">

                        <div class='col-6'>
                            <div class="form-group">
                                <label for="text-area">Select Type </label>
                                <select name="type" id="type" class="form-control">
                                    <option>AUTHOR</option>
                                    <option>PUBLISHER</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Title*</label>
                            <input type="text" name="membership_plan_name" id="title" class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Slug*</label>
                            <input type="text" name="membership_plan_slug" id="membership_plan_slug"
                                class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Monthly Price*</label>
                            <input type="number" name="membership_plan_monthly_price" id="membership_plan_monthly_price"
                                required class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Monthly Price Stripe Key*</label>
                            <input type="text" name="membership_plan_monthly_stripe_plan"
                                id="membership_plan_monthly_stripe_plan" required class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Yearly Price*</label>
                            <input type="number" name="membership_plan_yearly_price" id="membership_plan_yearly_price"
                                required class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Yearly Price Stripe Key*</label>
                            <input type="text" name="membership_plan_yearly_stripe_plan"
                                id="membership_plan_yearly_stripe_plan" required class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Max Book In Number*</label>
                            <input type="number" name="max_no_of_books" id="max_no_of_books" class="form-control" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title" class="label">Membership Plan Max Events In Number*</label>
                            <input type="number" name="max_no_of_events" id="max_no_of_events" class="form-control" />
                        </div>

                        {{-- <div class="form-group col-md-6">
                        <label for="title" class="label">Membership Plan Max Video Promotion In Number*</label>
                        <input type="number" name="max_no_of_video_promotion" id="max_no_of_video_promotion" class="form-control" />
                    </div> --}}


                        <div class="form-row" style="display: none;width: 100%;" id="publisherXtra">

                            <div class="form-group col-md-6">
                                <label for="title" class="label">Membership Plan Max Author Account In Number*</label>
                                <input type="number" name="max_author_account" id="max_author_account"
                                    class="form-control" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title" class="label">Membership Plan Author Max Book In Number*</label>
                                <input type="number" name="author_max_no_of_books" id="author_max_no_of_books"
                                    class="form-control" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title" class="label">Membership Plan Author Max Event In Number*</label>
                                <input type="number" name="author_max_no_of_events" id="author_max_no_of_events"
                                    class="form-control" />
                            </div>

                        </div>

                        <div class="form-group col-md-12">
                            <label for="title" class="label">Membership Plan Description</label>
                            <textarea id="summernote" name="membership_plan_description"></textarea>
                        </div>

                        <div class='col-6'>
                            <div class="form-group">
                                <label for="text-area">Select Status</label>
                                <select name="membership_plan_status" id="membership_plan_status" class="form-control">
                                    <option value="1">Publish</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <button type="button" id="add_btn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </div>

    <script>
        $("#add_btn").click(function() {
            $('.loader').show();
            $(".error_msg").html('');
            var data = new FormData($('#add_form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('admin/membership-plans') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {

                }
            }).done(function() {
                $('.loader').hide();
                $("#success_msg").html("Data Save Successfully");
                window.location.href = "{{ url('admin/membership-plans') }}";
            }).fail(function(data, textStatus, jqXHR) {
                $('.loader').hide();
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after(
                        "<span class='error_msg' style='color: red;font-weigh: 600'>" + value +
                        "</span>");
                });
            });

        });

        $('#type').change(function() {
            if ($(this).val() == 'PUBLISHER') {
                $('#publisherXtra').show();
            } else {
                $('#publisherXtra').hide();
            }
        })

        $('#title').on('keyup blur', function() {
            if (/^[a-zA-Z0-9 ]+$/.test($(this).val())) {
                var titleInput = $(this).val().toLowerCase().trim().replace(/[^a-z0-9-]+/g, '-');
                $('#membership_plan_slug').val(titleInput);
            }
        });
    </script>
@endsection

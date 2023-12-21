@extends('layouts.backend.master')



@section('content')



<style>
    span.select2.select2-container.select2-container--default {

        width: 450px !important;

    }

    .user-info__item {
        margin-bottom: 30px;
    }

    .user-info {
        padding: 15px;
    }

    .user-info__item h4 {}

    .user-info__item p {
        font-size: 18px;
    }
</style>

<br>

<div class="col-12">

    <div class="card">

        <div class="card-header">

            <h4 class="card-title">User Info</h4>



        </div>

        <!-- /.card-header -->

        <div class="card-body">

            <div class="user-info">



                <div class="user-info__item">

                    <h4>Name :</h4>

                    <p>{{ $user_data->name }}</p>

                    {{--<input type="text" class="form-control" name="name" id="name" value="{{ $user_data->name }}" placeholder="Enter Name">--}}

                </div>

                <div class="user-info__item">

                    <h4>Email :</h4>

                    <p>{{$user_data->email}}</p>

                    {{--<input type="text" class="form-control" name="email" id="email" value="{{ $user_data->email }}" placeholder="Enter Email">--}}

                </div>

                <div class="user-info__item">

                    <h4> Roles :</h4>

                    <p style="color:#000000">
                        @foreach($all_roles as $row)
                        @if($user_data->role_id == $row->id)
                        {{$row->name}}
                        @endif
                        @endforeach
                    </p>

                </div>

                {{--<div class="form-group col-md-6">--}}

                {{--<label for="Name">Password</label>--}}

                {{--<input type="password" class="form-control" name="password" id="password" autocomplete="off"--}}

                {{--placeholder="Enter Password">--}}

                {{--</div>--}}

                {{--<div class="form-group col-md-6">--}}

                {{--<label for="Name">Confirm Password</label>--}}

                {{--<input type="password" class="form-control" name="confirm_password" id="confirm_password"--}}

                {{--placeholder="Confirm Password">--}}

                {{--</div>--}}



            </div>





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

            url: "{{url("
            admin / users ")}}/" + $("[name=id]").val(),

            data: data,

            cache: false,

            contentType: false,

            processData: false,

            success: function(data, textStatus, jqXHR) {



            }

        }).done(function() {

            $("#success_msg").html("Data Save Successfully");

            window.location.href = "{{ url('admin/users')}}";

            // location.reload();

        }).fail(function(data, textStatus, jqXHR) {

            var json_data = JSON.parse(data.responseText);

            $.each(json_data.errors, function(key, value) {

                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");

            });

        });

        $('.loader').hide();

    });
</script>





@endsection
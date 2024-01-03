@extends('master')

@section('content')
<!-- Content Block -->
<section class="body-content pb-57 alt-content">
    <div class="container">
        <div class="inner-content">
            <div class="tab-panel">

                <nav>
                    @include('layouts.frontend.user_sidebar')
                </nav>
            </div>
            <div class="tab-content">
                <div class="tab-body__inner">
                    @foreach ($events as $row)
                        <div class="event-card">
                            <figure class="figure">
                                <img style="height: 60px;width:60px" src="@if($row->Author->author_profile_picture) {{asset($row->Author->author_profile_picture)}} @else {{asset('public/frontend_asset')}}/imgs/profile.jpg @endif" alt="" />
                            </figure>
                            <div class="content">
                                <div class="event-card__row flex-wrap">
                                    <h3 class="event-card__title">
                                        {{$row->event_name}}
                                    </h3>

                                </div>
                                <p class="event-card__timezone flex-wrap">
                                    {{$row->event_date}}<span class="center">{{$row->event_starting_time}}- {{$row->event_ending_time}}
                                    </span><span>{{$row->event_location}}</span>
                                </p>
                                <?php
                                                    $text = $row->event_description;
                                                    if(strlen($text) > 30){

                                                    $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                                    $countLength = strlen($firstPara);
                                                    $secondPara = substr($text, strpos($text,true) + ($countLength));
                                                    }else{
                                                        $firstPara = $row->book_description ?? '';
                                                    }
                                                                            ?>
                                <p class="para">
                                    <span class="main">
                                        {{$firstPara}}
                                    </span>
                                    @if(strlen($text) > 30)
                                    <span class="extended">
                                        {{$secondPara}}
                                    </span>
                                    <span class="read-more">Show More</span>
                                    @endif
                                </p>
                                <p class="para">
                                    <a href="{{$row->event_link}}" target="__blank">Join Link</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>


        </div>
    </div>
    </div>
</section>
<script>
    function addtoLibrary(bookId) {
        showCalimaticLoader();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "{{url("book-add-to-library")}}",
            data: {
                book_id: bookId
            },
            success: function(data, textStatus, jqXHR) {
                if (data.status == 1) {

                    $('#Book' + bookId).text('Added to Library');
                }

            }
        }).done(function() {
            $("#success_msg").html("Data Save Successfully");
            //  window.location.href = "{{ url('admin/users')}}";
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value) {
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        HideCalimaticLoader();
    }

    function RemoveFromLibrary(Id) {
        showCalimaticLoader();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "{{url("remove-book-from-library ")}}",
            data: {
                id: Id
            },
            success: function(data, textStatus, jqXHR) {
                if (data.status == 1) {

                    $('#AddedBook' + Id).text('Removed from Library');
                }

            }
        }).done(function() {
            $("#success_msg").html("Data Save Successfully");
            //  window.location.href = "{{ url('admin/users')}}";
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value) {
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        HideCalimaticLoader();
    }
</script>
@endsection

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
           
                    <!-- Cards Author Area -->
                    <div class="Authors-holder">
                        <h2 class="title">Followed Authors</h2>
                       
                        <div class="inner-authors">
                            <div class="autors-blocks">
                              @if(count($followed_authors)<=0)

                                    <div>You have no followed authors</div>

                                @endif
                                @foreach ($followed_authors as $followed)
                                    
                               
                                <div class="author-d-block">
                                    <div class="inner__author-block">
                                        <div class="author-block__header flex-wrap">
                                            <div class="author_info flex gp-27">
                                                <a href="{{url('author-details/'.$followed->author_id)}}">
                                                <img height="60px" width="60px" src="{{asset($followed->Author->author_profile_picture ?? '')}}" alt="" class="author-img" />
                                                </a>
                                                <div class="author_deteals">
                                                    <a href="{{url('author-details/'.$followed->author_id)}}">
                                                    <div class="author_name">
                                                        {{$followed->Author->author_name}}
                                                    </div>
                                                </a>
                                                    <div class="author_followers flex">
                                                        <div class="followers dote">
                                                            {{get_author_total_books_count_by_author_id($followed->Author->id)}} Books
                                                        </div>
                                                        <div class="followers">
                                                            {{get_author_total_followers_count_by_author_id($followed->Author->id)}} Followers
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="follower-btn" id="followingAuthor{{$followed->id}}" onclick="UnfollowAuthor({{$followed->id}})">
                                                Unfollow
                                            </button>
                                        </div>
                                        <div class="author-block__body flex-equal">
                                            <div class="author-block__imgs flex-wrap">
                                                <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-20.png"
                                                    alt="" class="author-block__img" />
                                                <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-20.png"
                                                    alt="" class="author-block__img" />
                                            </div>
                                            <div class="author-block__dec">
                                                {{$followed->Author->author_description}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function followAuthor(authorId){
            showCalimaticLoader();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "{{url("follow-author")}}",
            data: {author_id:authorId},
            success: function (data, textStatus, jqXHR) {
                if(data.status == 1){

                    $('#author'+authorId).text('Follwing');
                }
                
            }
        }).done(function() {
            $("#success_msg").html("Data Save Successfully");
            //  window.location.href = "{{ url('admin/users')}}";
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        HideCalimaticLoader();
        }

        function UnfollowAuthor(Id){
            showCalimaticLoader();
        $(".error_msg").html('');
        var data = new FormData($('#add_form')[0]);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "{{url("unfollow-author")}}",
            data: {id:Id},
            success: function (data, textStatus, jqXHR) {
                if(data.status == 1){

                    $('#followingAuthor'+Id).text('Follow');
                }
                
            }
        }).done(function() {
            $("#success_msg").html("Data Save Successfully");
            //  window.location.href = "{{ url('admin/users')}}";
            // location.reload();
        }).fail(function(data, textStatus, jqXHR) {
            var json_data = JSON.parse(data.responseText);
            $.each(json_data.errors, function(key, value){
                $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" + value + "</span>");
            });
        });
        HideCalimaticLoader();
        }
    </script>
@endsection

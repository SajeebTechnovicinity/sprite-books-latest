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
                    <h2 class="heading mb-54">Trending Authors</h2>
                    <p class="message">Connect with the people like you.</p>

                    <!-- Cards Author Area -->
                    <div class="Author-holder">
                        <div class="pt-b title-bar flex-equal">
                            <h3 class="title">Top Authors</h3>
                            <div class="select-wrap">
                                <select name="type" class="select">
                                    <option value="1">Top 10</option>
                                    <option value="2">Top 9</option>
                                    <option value="3">Top 8</option>
                                    <option value="4">Top 7</option>
                                    <option value="5">Top 6</option>
                                    <option value="6">Top 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="top-authors">
                            @foreach ($authors as $row)
                                <div class="inner__top-authors">
                                    <div class="author-d-block">
                                        <div class="inner__author-block">
                                            <div class="author-block__header flex-wrap">
                                                <div class="author_info flex gp-27">
                                                    <a href="{{ url('author-details/' . $row->id) }}">
                                                        <img height="60px" width="60px"
                                                            src="{{ asset($row->author_profile_picture ?? '') }}"
                                                            alt="" class="author-img" />
                                                    </a>
                                                    <div class="author_deteals">
                                                        <a href="{{ url('author-details/' . $row->id) }}">
                                                            <div class="author_name">
                                                                {{ $row->author_name }}
                                                            </div>
                                                        </a>
                                                        <div class="author_followers flex">
                                                            <div class="followers dote">
                                                                {{ get_author_total_books_count_by_author_id($row->id) }}
                                                                Books
                                                            </div>
                                                            <div class="followers">
                                                                {{ get_author_total_followers_count_by_author_id($row->id) }}
                                                                Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="follower-btn" id="author{{ $row->id }}"
                                                    onclick="follow({{ $row->id }})">
                                                    Follow
                                                </button>
                                            </div>
                                            <div class="author-block__body flex-equal">
                                                <div class="author-block__imgs flex-wrap">
                                                    @foreach (get_author_last_two_books_by_author_id($row->id) as $rowBook1)
                                                        @if (isset($rowBook1->bookDocuments[0]))
                                                            <a href="{{ url('book-details/' . $rowBook1->id) }}">
                                                                <img src="{{ asset($rowBook1->bookDocuments[0]->path) }}"
                                                                    alt="" class="author-block__img" />
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="author-block__dec">
                                                    {{ $row->author_description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                                                    <a href="{{ url('author-details/' . $followed->author_id) }}">
                                                        <img height="60px" width="60px"
                                                            src="{{ asset($followed->Author->author_profile_picture ?? '') }}"
                                                            alt="" class="author-img" />
                                                    </a>
                                                    <div class="author_deteals">
                                                        <a href="{{ url('author-details/' . $followed->author_id) }}">
                                                            <div class="author_name">
                                                                {{ $followed->Author->author_name }}
                                                            </div>
                                                        </a>
                                                        <div class="author_followers flex">
                                                            <div class="followers dote">
                                                                {{ get_author_total_books_count_by_author_id($followed->Author->id) }}
                                                                Books
                                                            </div>
                                                            <div class="followers">
                                                                {{ get_author_total_followers_count_by_author_id($followed->Author->id) }}
                                                                Followers
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="follower-btn" id="followingAuthor{{ $followed->id }}"
                                                    onclick="UnfollowAuthor({{ $followed->id }})">
                                                    Unfollow
                                                </button>
                                            </div>
                                            <div class="author-block__body flex-equal">
                                                <div class="author-block__imgs flex-wrap">
                                                    @foreach (get_author_last_two_books_by_author_id($followed->author_id) as $rowBook)
                                                        <a href="{{ url('book-details/' . $rowBook->id) }}">
                                                            <img src="{{ asset($rowBook->bookDocuments[0]->path ?? '') }}"
                                                                alt="" class="author-block__img" />
                                                        </a>
                                                    @endforeach
                                                </div>
                                                <div class="author-block__dec">
                                                    {{ $followed->Author->author_description }}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      
        function follow(authorId) {
            showCalimaticLoader();
            $(".error_msg").html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('follow-author') }}",
                data: {
                    author_id: authorId
                },
                success: function(data) {
                    
                    if (data.status == 1) {
                        $('#author' + authorId).text('Following');

                        Swal.fire({
                            title: 'Success!',
                            text: 'You are now following the author.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                    else
                    {
                         Swal.fire({
                            title: 'Error!',
                            text: data.data,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(data) {
                    //console.log(data);
                    var json_data = JSON.parse(data.responseText);
                    $.each(json_data.errors, function(key, value) {
                        $("#" + key).after("<span class='error_msg' style='color: red;font-weight: 600'>" +
                            value + "</span>");
                    });
                },
                complete: function() {
                    HideCalimaticLoader();
                }
            });
        }

        function UnfollowAuthor(Id) {

            showCalimaticLoader();
            $(".error_msg").html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ url('unfollow-author') }}",
                data: {
                    id: Id
                },
                success: function(data) {
                    if (data.status == 1) {
                        $('#followingAuthor' + Id).text('Follow');
                    }
                },
                error: function(data) {
                    var json_data = JSON.parse(data.responseText);
                    $.each(json_data.errors, function(key, value) {
                        $("#" + key).after("<span class='error_msg' style='color: red;font-weight: 600'>" +
                            value + "</span>");
                    });
                },
                complete: function() {
                    HideCalimaticLoader();
                }
            });
        }
    </script>
@endsection

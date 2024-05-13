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
                        <h2 class="title">Your Libraries</h2>

                        <div class="inner-authors">
                            <div class="autors-blocks">
                              @if(count($mylibraries)<=0)

                                    <div>You have no books in library</div>

                                @endif
                                @foreach ($mylibraries as $rowLibrary)
                                    <div class="author-d-block">
                                        <div class="inner__author-block">
                                            <div class="author-block__header flex-wrap gp-27">
                                                <div class="author_info flex gp-27">
                                                    {{-- <img src="{{asset($row->bookDocuments[0]->path)}}" alt="" class="author-img" /> --}}
                                                    <div class="author_deteals">
                                                        <a href="{{ url('book-details/' . $rowLibrary->book_id) }}">
                                                            <div class="author_name">
                                                                {{ $rowLibrary->Book->book_name ?? '' }}
                                                            </div>
                                                        </a>
                                                        <div class="author_followers flex">
                                                            {{-- <div class="followers dote mr-23">
                                                            221 Followers
                                                        </div>
                                                        <div class="followers">
                                                            221 Followers
                                                        </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <button title="Remove From Library" class="follower-btn follower-remove-btn" id="AddedBook{{ $rowLibrary->id }}"
                                                    onclick="RemoveFromLibrary({{ $rowLibrary->id }})">
                                                    Remove
                                                </button>
                                            </div>
                                            <div class="author-block__body flex-equal">
                                                <div class="author-block__imgs flex-wrap">
                                                    <a href="{{ url('book-details/' . $rowLibrary->id) }}"> <img
                                                            src="{{ asset($rowLibrary->Book->bookDocuments[0]->path ?? '') }}"
                                                            alt="" class="author-block__img" />
                                                    </a>
                                                    {{-- <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-20.png"
                                                    alt="" class="author-block__img" /> --}}
                                                </div>
                                                <?php
                                                $text = $row->Book->book_description ?? '';
                                                if (strlen($text) > 30) {
                                                    $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                                    $countLength = strlen($firstPara);
                                                    $secondPara = substr($text, strpos($text, true) + $countLength);
                                                } else {
                                                    $firstPara = $row->book_description ?? '';
                                                }
                                                ?>

                                                <div class="author-block__dec" style="margin-left: 10px;">
                                                    <p class="para">
                                                        <span class="main">
                                                            {{ $firstPara }}
                                                        </span>
                                                        @if (strlen($text) > 30)
                                                            <span class="extended">
                                                                {{ $secondPara }}
                                                            </span>
                                                            <span class="read-more">Show More</span>
                                                        @endif
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Cards Author Area -->
                    <div class="Authors-holder mt-40">
                        <h2 class="title">Latest Books</h2>
                        <div class="inner-authors">
                            <div class="autors-blocks">
                             @if(count($books)<=0)

                                    <div>You have no books in latest</div>

                                @endif
                                @foreach ($books as $row)
                                    <div class="author-d-block">
                                        <div class="inner__author-block">
                                            <div class="author-block__header flex-wrap gp-27">
                                                <div class="author_info flex gp-27">
                                                    {{-- <img src="{{asset($row->bookDocuments[0]->path)}}" alt="" class="author-img" /> --}}
                                                    <div class="author_deteals">
                                                        <a href="{{ url('book-details/' . $row->id) }}">
                                                            <div class="author_name">
                                                                {{ $row->book_name }}
                                                            </div>
                                                        </a>
                                                        <div class="author_followers flex">
                                                            {{-- <div class="followers dote mr-23">
                                                            221 Followers
                                                        </div>
                                                        <div class="followers">
                                                            221 Followers
                                                        </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $libray=DB::table('book_libraries')->where('book_id',$row->id)->where('user_id',session('author_id'))->where('added_by',session('author_id'))->count();
                                                @endphp
                                                @if($libray==0)
                                                <button class="follower-btn" id="Book{{ $row->id }}"
                                                    onclick="addtoLibrary({{ $row->id }})">
                                                    Add to Library
                                                </button>
                                                @else
                                                    <button class="follower-btn"
                                                        disabled>
                                                    Already Added to Library
                                                </button>
                                                @endif
                                            </div>
                                            <div class="author-block__body flex-equal">
                                                <div class="author-block__imgs flex-wrap">
                                                    <a href="{{ url('book-details/' . $row->id) }}">
                                                        @if (isset($row->bookDocuments[0]))
                                                            <img src="{{ asset($row->bookDocuments[0]->path) }}"
                                                                alt="" class="author-block__img" />
                                                        @endif
                                                    </a>
                                                    {{-- <img src="{{ asset('public/frontend_asset') }}/imgs/placeholder-20.png"
                                                    alt="" class="author-block__img" /> --}}
                                                </div>
                                                <?php
                                                $text = $row->book_description ?? '';
                                                if (strlen($text) > 30) {
                                                    $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                                    $countLength = strlen($firstPara);
                                                    $secondPara = substr($text, strpos($text, true) + $countLength);
                                                } else {
                                                    $firstPara = $row->book_description ?? '';
                                                }
                                                ?>

                                                <div class="author-block__dec" style="margin-left: 10px;">
                                                    <p class="para">
                                                        <span class="main">
                                                            {!! $firstPara !!}
                                                        </span>
                                                        @if (strlen($text) > 30)
                                                            <span class="extended">
                                                                {!! $secondPara !!}
                                                            </span>
                                                            <span class="read-more">Show More</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex" style="display: none;">
                                {!! $books->links() !!}
                            </div>

                        </div>
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
                url: "{{ url('book-add-to-library') }}",
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
                //  window.location.href = "{{ url('admin/users') }}";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" +
                        value + "</span>");
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
                url: "{{ url('remove-book-from-library') }}",
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
                //  window.location.href = "{{ url('admin/users') }}";
                // location.reload();
            }).fail(function(data, textStatus, jqXHR) {
                var json_data = JSON.parse(data.responseText);
                $.each(json_data.errors, function(key, value) {
                    $("#" + key).after("<span class='error_msg' style='color: red;font-weigh: 600'>" +
                        value + "</span>");
                });
            });
            HideCalimaticLoader();
        }
    </script>
@endsection

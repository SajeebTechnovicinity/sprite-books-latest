@extends('master')

@section('content')
<style>
    .hidden {
        display: none;
    }
</style>
<!-- Content Block -->
<section class="body-content alt-content book-details">
    <div class="container">
        <div class="inner-content">
            <div class="book-search-wrap">
                <!-- Content Block -->
                <div class="book-search">
                    <div class="block-component">

                        <!-- Grid Items -->
                        <div class="grid-container author-inheritance">
                            <div class="title-bar flex-equal">
                                <h3 class="title">Books</h3>
                            </div>
                            @if ($books->isNotEmpty())
                            <div class="grid-items">
                                @foreach ($books as $sBooks)

                                <div class="card grid-item">
                                    @if (isset($sBooks->bookDocuments[0]))
                                    <a href="{{ url('book-details/' . $sBooks->id) }}" class="figure">
                                        <img src="{{ asset($sBooks->bookDocuments[0]->path) }}" alt="" />
                                    </a>
                                    @endif
                                    <div class="text-wrap">
                                        <h5 class="subtitle">PAPERBACK</h5>
                                        <a href="{{ url('book-details/' . $sBooks->id) }}" class="title">{{ $sBooks->book_name }}</a>

                                        <div class="blog-meta">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                                </svg> Book Tree Admin
                                            </span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                                                </svg>

                                                20 December 2024
                                            </span>
                                        </div>

                                        <?php
                                        $text = $sBooks->book_description;
                                        if (strlen($text) > 30) {
                                            $firstPara = substr($text, 0, strpos($text, ' ', 30));
                                            $countLength = strlen($firstPara);
                                            $secondPara = substr($text, strpos($text, true) + $countLength);
                                        } else {
                                            $firstPara = $row->book_description ?? '';
                                        }
                                        ?>

                                        <p class="para">
                                            <span class="main">
                                                {{ $firstPara }}
                                            </span>
                                            @if (strlen($text) > 30)
                                            <span class="extended">
                                                {{ $secondPara }}
                                            </span>
                                            {{-- <span class="read-more">Show More</span> --}}
                                            @endif
                                        </p>

                                        {{-- <p class="dsc">
                                        {{Illuminate\Support\Str::of($sBooks->book_description ?? '')->words(10, ' ...')}}
                                        </p> --}}

                                        {{-- <span class="ratting-poing">8.9</span> --}}
                                        <a href="{{ url('book-details/' . $sBooks->id) }}" class="card-link">
                                            Details</a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h5 class="title">No other books available</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<script>
    function showShareButton() {
        $('#shareButtons').show();
    }
</script>
<script>
    $(document).ready(function() {
        // Initially hide the book_author field and disable the author label
        $('#book_author, #author_label, #author_text').addClass('hidden');

        // On radio button change
        $('input[name="author_define"]').change(function() {
            if ($(this).val() === 'Author') {
                // If Author is selected, show the book_author field and enable the author label
                $('#book_author, #author_label, #author_text').removeClass('hidden');
            } else {
                // If Publisher is selected, hide the book_author field and disable the author label
                $('#book_author, #author_label, #author_text').addClass('hidden');
            }
        });
    });
</script>
<script>
    function validateForm() {
        var authorDefine = document.querySelector('input[name="author_define"]:checked');

        if (!authorDefine) {
            alert('Please select a role (Publisher or Author).');
            return;
        }

        // Additional validation logic can be added here if needed

        // If the form is valid, you can submit it
        document.getElementById('myForm').submit();
    }
</script>
@endsection
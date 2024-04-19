<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=EB+Garamond:wght@400;500;700&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $blog->meta_title }}</title>
    <meta name="description" content={{ $blog->meta_description }}>
    <meta name="keywords" content={{ $blog->meta_keyword }}>
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend_asset') }}/css/slick-1.8.1.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend_asset') }}/css/style.css" />
    <!-- jQuary -->
    <script src="{{ asset('public/frontend_asset') }}/js/jquery-3.7.0.min.js"></script>

    

    <script>
        window.Userback = window.Userback || {};
        Userback.access_token = '3546|87888|ImQNwGVYOAE8Mskgmyn1BqRNELZMj5Sj1ibaMuH8oDWxMVjZgG';
        (function(d) {
            var s = d.createElement('script');
            s.async = true;
            s.src = 'https://static.userback.io/widget/v1.js';
            (d.head || d.body).appendChild(s);
        })(document);
    </script>


    <style>
        /*Comments */
        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        #fbcomment {
            background: #fff;
            border: 1px solid #dddfe2;
            border-radius: 3px;
            color: #4b4f56;
            padding: 50px;
        }

        .header_comment {
            font-size: 14px;
            overflow: hidden;
            border-bottom: 1px solid #e9ebee;
            line-height: 25px;
            margin-bottom: 24px;
            padding: 10px 0;
        }

        .sort_title {
            color: #4b4f56;
        }

        .sort_by {
            background-color: #f5f6f7;
            color: #4b4f56;
            line-height: 22px;
            cursor: pointer;
            vertical-align: top;
            font-size: 12px;
            font-weight: bold;
            vertical-align: middle;
            padding: 4px;
            justify-content: center;
            border-radius: 2px;
            border: 1px solid #ccd0d5;
        }

        .count_comment {
            font-weight: 600;
        }

        .body_comment {
            padding: 0 8px;
            font-size: 14px;
            display: block;
            line-height: 25px;
            word-break: break-word;
        }

        .avatar_comment {
            display: block;
            flex: 0 0 10%;
            margin-right: 15px;
        }

        .avatar_comment img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .box_comment {
            display: block;
            position: relative;
            line-height: 1.358;
            word-break: break-word;
            border: 1px solid #d3d6db;
            word-wrap: break-word;
            background: #fff;
            box-sizing: border-box;
            cursor: text;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            padding: 0;
        }

        .box_comment textarea {
            min-height: 40px;
            padding: 12px 8px;
            width: 100%;
            border: none;
            resize: none;
        }

        .box_comment textarea:focus {
            outline: none !important;
        }

        .box_comment .box_post {
            border-top: 1px solid #d3d6db;
            background: #f5f6f7;
            padding: 8px;
            display: block;
            overflow: hidden;
        }

        .box_comment label {
            display: inline-block;
            vertical-align: middle;
            font-size: 11px;
            color: #90949c;
            line-height: 22px;
        }

        .box_comment button {
            margin-left: 8px;
            background-color: #4267b2;
            border: 1px solid #4267b2;
            color: #fff;
            text-decoration: none;
            line-height: 22px;
            border-radius: 2px;
            font-size: 14px;
            font-weight: bold;
            position: relative;
            text-align: center;
        }

        .box_comment button:hover {
            background-color: #29487d;
            border-color: #29487d;
        }

        .box_reply {
            display: flex;
        }

        .box_comment .cancel {
            margin-left: 8px;
            background-color: #f5f6f7;
            color: #4b4f56;
            text-decoration: none;
            line-height: 22px;
            border-radius: 2px;
            font-size: 14px;
            font-weight: bold;
            position: relative;
            text-align: center;
            border-color: #ccd0d5;
        }

        .box_comment .cancel:hover {
            background-color: #d0d0d0;
            border-color: #ccd0d5;
        }

        .box_comment img {
            height: 16px;
            width: 16px;
        }

        .box_result {
            margin-top: 24px;
            display: flex;
        }

        .box_result .result_comment h4 {
            font-weight: 600;
            white-space: nowrap;
            color: #365899;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            line-height: 1.358;
            margin: 0;
        }

        .box_result .result_comment {
            display: block;
            overflow: hidden;
            padding: 0;
        }

        .child_replay {
            margin-top: 12px;
            list-style: none;
            padding: 0 0 0 8px;
        }

        .reply_comment {
            margin: 12px 0;
        }

        .box_result .result_comment p {
            margin: 4px 0;
            text-align: justify;
        }

        .box_result .result_comment .tools_comment {
            font-size: 12px;
            line-height: 1.358;
        }

        .box_result .result_comment .tools_comment a {
            color: #4267b2;
            cursor: pointer;
            text-decoration: none;
        }

        .box_result .result_comment .tools_comment span {
            color: #90949c;
        }

        .body_comment .show_more,
        .body_comment .show_less {
            background: #3578e5;
            border: none;
            box-sizing: border-box;
            color: #fff;
            font-size: 14px;
            margin-top: 24px;
            padding: 12px;
            text-shadow: none;
            width: 100%;
            font-weight: bold;
            position: relative;
            text-align: center;
            vertical-align: middle;
            border-radius: 2px;
        }

        .comments_input_inner {
            margin-bottom: 25px !important;
            display: none;
        }

        .comments_input_inner img {
            height: 46px !important;
            width: 46px !important;
        }

        .comments_input_inner input {
            height: 46px !important;
        }
    </style>

    <title>Mybox | Home</title>
    <style>
        .ripple__rounds {
            border: 0 solid transparent;
            border-radius: 50%;
            position: relative;
        }

        .ripple__rounds:before,
        .ripple__rounds:after {
            content: '';
            border: 0.5em solid rgb(19, 5, 5);
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            animation: ripple__rounds 1s linear infinite;
            opacity: 0;
        }

        .ripple__rounds:before {
            animation-delay: .5s;
        }

        .ripple__rounds:after {
            animation-delay: 0;
        }

        @keyframes ripple__rounds {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        [class*=ripple__rounds] {
            display: contents;
            width: 8em;
            height: 8em;
            color: inherit;
            vertical-align: middle;
            pointer-events: none;
            /* background-color: #538347; */
        }

        .box {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* background: #e9e9e987; */
            position: fixed;
            top: 0;
            left: 0;
        }

        .not-show {
            display: none;
        }
    </style>
    <script>
        function showCalimaticLoader() {

            document.getElementById('custom__ripple_Loader').classList.remove("not-show")
        }
        // to show loader
        function HideCalimaticLoader() {
            document.getElementById('custom__ripple_Loader').classList.add("not-show")
        }
    </script>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v18.0"
        nonce="iNMFWglc"></script>
    <!-- Header -->
    @if (session('author_id'))
        @include('layouts.frontend.author_header')
    @else
        @include('layouts.frontend.header')
    @endif

    <div id="custom__ripple_Loader" class="box not-show" style="top: 50%;left: 21%;">
        <div class="ripple__rounds"></div>
    </div>

    <!-- Cards Holder -->
    <section class="page-blog-details">
        <div class="container">

            <div class="blog-details">
                <figure class="figure">
                    <img src="{{ asset($blog->blog_image) }}" alt="{{ $blog->blog_name }}" />
                </figure>
                <h1 class="title">{{ $blog->blog_name }}</h1>
                <div class="blog-meta">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg>
                        @if ($blog->author)
                            {{ $blog->author->author_name }}
                        @else
                            {{--  Book Tree Admin  --}}
                        @endif

                        @if ($blog->author_id == null)
                            Book Tree Admin
                        @endif

                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" />
                        </svg>

                        {{ date('d M, Y', strtotime($blog->created_at)) }}
                    </span>
                </div>

                <div class="entry-content">

                    <p>{{ $blog->blog_short_description }}</p>

                    {!! $blog->blog_full_description !!}

                </div>

            </div>
        </div>
    </section>

    <!-- footer -->
    @include('layouts.frontend.footer')

    @include('layouts.frontend.footerlink')

</body>

</html>

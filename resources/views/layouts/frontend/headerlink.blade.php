<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=EB+Garamond:wght@400;500;700&display=swap" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Slick CSS -->
<link rel="stylesheet" href="{{asset('public/frontend_asset')}}/css/slick-1.8.1.min.css" />

<!-- CSS -->
<link rel="stylesheet" href="{{asset('public/frontend_asset')}}/css/style.css" />
<!-- jQuary -->
<script src="{{asset('public/frontend_asset')}}/js/jquery-3.7.0.min.js"></script>

<title>Home</title>

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

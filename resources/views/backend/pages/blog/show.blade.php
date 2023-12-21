@extends('layouts.backend.master')

@section('content')
    <style>
        span.select2.select2-container.select2-container--default {
            width: 450px !important;
        }
    </style>
    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Blog Info</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body" style="text-align: center">
                <img class="image " style="text-align: center" src="{{ asset($blog->blog_image) }}">
                <h3>{{ $blog->blog_name }}</h3>
                <br>
                <?php
                $li_class = '';
                
                $paragraphs = explode("\n", $blog->blog_short_description);
                
                for ($i = 0; $i < count($paragraphs); $i++) {
                    if (ord($paragraphs[$i][0]) !== 13) {
                        $paragraphs[$i] = '<p>' . $paragraphs[$i] . '</p>';
                    }
                }
                $content = implode('', $paragraphs);
                $content = preg_replace('~\s?<p>\n</p>\s?~', '', $content);
                if (count($paragraphs) === 1) {
                    $li_class = 'no-list';
                }
                ?>
                {!! $content !!}
                <p>{!! $blog->blog_short_description !!}</p>
                <br>
                
                <p>{!! $blog->blog_full_description !!}</p>


            </div>


        </div>
    </div>


    </div>
@endsection

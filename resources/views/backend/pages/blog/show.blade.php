@extends('layouts.backend.master')

@section('content')

<style>
    span.select2.select2-container.select2-container--default{
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
           <img class="image " style="text-align: center" src="{{asset($blog->blog_image)}}">
           <h3>{{$blog->blog_name}}</h3>
           <br>
           <p>{{$blog->blog_short_description}}</p>
           <br>
           <p>{!!$blog->blog_full_description!!}</p>


                </div>


        </div>
    </div>


</div>


@endsection



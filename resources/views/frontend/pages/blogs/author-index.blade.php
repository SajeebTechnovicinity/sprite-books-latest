@extends('master')

@section('content')

      <!-- Cards Holder -->
      <section class="cards-holder Author-Blogs">
        <div class="container">
          <div class="title">
            <h4 class="title__sub">Blog post from author</h4>
            <h2 class="title__main">Author Blogs</h2>
          </div>
          <div class="cards leading-cards">


            @if($list->count()<=0)

                No Blog Available!

            @endif
            <div class="card-wrap">
            @foreach ($list as $row)
              {{-- <div class="card-heading">Author of the Month</div> --}}
              <div class="card">
                <a href="{{url('blogs/'.$row->id)}}" class="figure">
                  <img src="{{asset($row->blog_image)}}" alt="No Image Available" />
                </a>
                <div class="text-wrap">
                  <a href="{{url('blogs/'.$row->id)}}" class="name">{{$row->blog_name}}</a>
                  <p class="bio"></p>
                  <p class="dsc">
                    {!! $row->blog_short_description !!}
                  </p>
                  @if($row->author)
                   <p class="dsc">
                        Author: {{$row->author->author_name}}
                  </p>
                  @endif
                  <a href="{{url('blogs/'.$row->id)}}" class="card-link">Read More</a>
                </div>
              </div>

            @endforeach
            </div>
          </div>
        </div>
      </section>

@endsection

@extends('master')

@section('content')

      <!-- Cards Holder -->
      <section class="cards-holder">
        <div class="container container-alt2">
          <div class="title">
            {{-- <h4 class="title__sub">Blog post from us</h4>
            <h2 class="title__main">fsdgts</h2> --}}
          </div>
          <div class="cards leading-cards">




            <div class="card-wrap">
              {{-- <div class="card-heading">Author of the Month</div> --}}
              <div class="card">
                <a href="{{url('blogs/'.$blog->id)}}" class="figure">
                  <img src="{{asset($blog->blog_image)}}" alt="No Image Available" />
                </a>
                <div class="text-wrap">
                  <a href="{{url('blogs/'.$blog->id)}}" class="name">{{$blog->blog_name}}</a>
                  <p class="bio"></p>
                  <p class="dsc">
                    {{$blog->blog_short_description}}
                  </p>
                  <p class="dsc">
                    {!!$blog->blog_full_description!!}
                  </p>
                  {{-- <a href="{{url('blog/'.$row->id)}}" class="card-link">Follow</a> --}}
                </div>
              </div>
            </div>


          </div>
        </div>
      </section>

@endsection

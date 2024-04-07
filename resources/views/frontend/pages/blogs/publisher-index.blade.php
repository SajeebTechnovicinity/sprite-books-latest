@extends('master')

@section('content')

<!-- Cards Holder -->
<section class="cards-holder Author-Blogs">
  <div class="container">
    <div class="title">
      <h4 class="title__sub">Blog post from publisher</h4>
      <h2 class="title__main">Publisher Blogs</h2>
    </div>
    <div class="cards leading-cards">

      @if($list->count()<=0) No Blog Available! @endif <div class="card-wrap">
        @foreach ($list as $row)
        {{-- <div class="card-heading">Author of the Month</div> --}}
        <div class="card">
          <a href="{{url('blogs/'.$row->id)}}" class="figure">
            <img src="{{asset($row->blog_image)}}" alt="No Image Available" />
          </a>
          <div class="text-wrap">
            <a href="{{url('blogs/'.$row->id)}}" class="name">{{$row->blog_name}}</a>
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

                {{ date('d M, Y', strtotime($row->created_at)) }}
              </span>
            </div>
            <p class="dsc">
              {!! $row->blog_short_description !!}
            </p>
            @if($row->author)
            <p class="dsc">
              Publisher: {{$row->author->author_name}}
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
@extends('master')

@section('content')
<div class="container">
    <div class="inner-content">
<div class="faq">
    <div class="form_header m-48">
      <h2 class="title">Frequently asked questions</h2>
      <div class="dec">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
        minim veniam
      </div>
    </div>
    <!-- accordion-->
    <div class="accordion_container m-auto">
      @foreach ($list as $row)


      <div class="accordion">
        <div class="accordion_header">
          <h2 class="accordion_title m-0">
           {{$row->question}}
          </h2>
          <svg
            class="arrow arrow-animate"
            width="32"
            height="32"
            viewBox="0 0 32 32"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M15.7297 22L6 12.2703L8.27027 10L15.7297 17.4595L23.1892 10L25.4595 12.2703L15.7297 22Z"
              fill="#090914"
            />
          </svg>
        </div>
        <div class="accordion_content @if($loop->iteration == 1) active @endif faq_acc-content">
          {{$row->answer}}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
</div>
@endsection
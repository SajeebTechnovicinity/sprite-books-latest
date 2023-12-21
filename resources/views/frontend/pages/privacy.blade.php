@extends('master')

@section('content')
<div class="Terms">
    <div class="form_header m-48">
      <h2 class="title">Privacy</h2>
      {{-- <div class="dec">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
        minim veniam
      </div> --}}
    </div>
    <div class="term_container">
      <p>{!! $globalSetting->privacy_policy !!}</p>
    </div>
  </div>
@endsection
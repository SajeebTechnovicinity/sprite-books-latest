@extends('master')

@section('content')

<?php $counter = 1; ?>

<section class="faq">
  <div class="container">

  <div class="form_header m-48">
        <h2 class="title">Frequently asked questions</h2>
        <div class="dec">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam
        </div>
      </div>
    <div class="faq__block">

    @foreach ($list as $row)
      <div class="faq__item">
        <div class="faq__item-header faq-trigger">
          <div class="faq__item__collapse-icon"></div>
          <h3 class="faq__item-title">
            <span><?php echo $counter; ?>.</span> {{$row->question}}
          </h3>
        </div>
        <div class="faq__item-body" style="display: none;">
          <p class="faq__item-dsc">
          {{$row->answer}}
          </p>
        </div>
      </div>
      <?php $counter++; ?>
      @endforeach



    </div>
  </div>
</section>

@endsection
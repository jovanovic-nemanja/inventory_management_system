@extends('layouts.app')

@section('content')

<section class="u-clearfix u-section-1" id="sec-3d70">
  <div class="container">
    <div class="row" style="padding-top: 10%; padding-bottom: 10%;">
      <div class="col-md-6">
        <h3 class="u-custom-font u-font-ubuntu u-text u-text-default u-text-1">How to buy on MamboDubai.com</h3>
        <p class="u-text u-text-default u-text-2">MamboDubai.com connects you with thousand of buyers that are ready to respond to your inquiries and send you quotes. Once you receive quotes, you are also able to look at the profiles of your suppliers and comments left by customers who had bought from them. After reviewing the quotes and checking the profiles of the sellers, you are able to award purchase order to the best quote.</p>
        
        @guest
          <a href="{{ route('emailverify') }}" class="u-btn u-button-style u-palette-2-base u-btn-1">Sign Up to Buy&nbsp;</a>
        @endguest
      </div>
      <div class="col-md-6">
        <img src="{{ asset('images/howtobuy.jpg') }}" />
      </div>
    </div>
  </div>
</section>
@stop

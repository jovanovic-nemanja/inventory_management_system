@extends('layouts.app')

@section('content')

<section class="u-clearfix u-section-1" id="sec-3d70">
  <div class="container">
    <div class="row" style="padding-top: 10%; padding-bottom: 10%;">
      <div class="col-md-6">
        <h3 class="u-custom-font u-font-ubuntu u-text u-text-default u-text-1">How to sell on Mambodubai.com</h3>
        <p class="u-text u-text-default u-text-2">Sign up on Mambodubai.com, list your products and get your first inquiry. You can respond to queries in a very easy and friendly platform. Once your quote is accepted, you can get the purchase order online and proceed to payment and shipping which all is manageable in our platform.</p>
        
        @guest
          <a href="{{ route('emailverifyseller') }}" class="u-btn u-button-style u-palette-2-base u-btn-1">Sign Up to Sell&nbsp;</a>
        @endguest
      </div>
      <div class="col-md-6">
        <img src="{{ asset('images/howtosell.jpg') }}" />
      </div>
    </div>
  </div>
</section>
@stop

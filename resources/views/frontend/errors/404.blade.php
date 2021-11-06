@extends('layouts.appsecond')

@section('content')
    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/"> Home</a> / About
        </div>
    </div>

    <div class="category-body margin50">

        <div class="container-fluid">
            <div class="ps-page--404">
                <div class="container">
                    <div class="ps-section__content"><img src="{{ asset('design/img/404.jpg') }}" alt="">
                        <h3>ohh! page not found</h3>
                        <p>It seems we can't find what you're looking for. Perhaps searching can help or go back to<a
                                href="{{ url('/') }}"> Homepage</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

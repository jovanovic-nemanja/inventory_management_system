@extends('layouts.appsecond')

@section('content')
    <div class="breadcamp">
        <div class="container-fluid">

        </div>
    </div>

    <div class="category-body margin50">

        <div class="container-fluid">
            <link href="{{ asset('new/product/Products.css') }}" rel="stylesheet">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 style="font-size: 6rem;">
                        <strong style="color: red;">
                            419
                        </strong>
                    </h1>
                    <h5>
                        The page has expired due to inactivity.
                        <br />
                        <br />
                        Please refresh and try again.
                    </h5>
                    <br>
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn btn-danger">Home</a>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="u-text u-text-1">Join us today</h3>
                    <p class="u-text u-text-default u-text-2">Become a member of
                        our importer-exportter community and get to feel tools meant for the business world
                        of tomorrow.</p>
                </div>
            </div>
        </div>
    </div>
@stop

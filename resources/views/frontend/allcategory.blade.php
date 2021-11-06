<!--@extends('layouts.appsecond')-->

@section('content')




    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/"> Home</a> / Allcategories
        </div>
    </div>

    <div class="category-body margin20">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="privacy-bodyy">
                        <h2 class="text-center">
                            ALL CATEGORIES
                        </h2>
                    </div>

                </div>
            </div>
            @foreach ($main_categories as $item)

                <div class="row margin20">
                    <div class="col-md-12">
                        <h2><a href="/product?category={{ $item->slug }}" target="_blank">{{ $item->name }}</a> </h2>
                    </div>
                    @foreach ($categories as $item1)
                    
                        @if($item1->parent == $item->id)
                        <div class="submenu-section col-md-3 margin10">
                        <h2 class="submenu-section-title">
                            <a target="_blank" href="/product?category={{ $item1->slug }}">
                                {{ $item1->name }} </a>
                        </h2>
                        @foreach ($categories as $item2)
                    
                        @if($item2->parent == $item1->id)
                        <h3 class="submenu-section-link">
                            <a target="_blank" href="/product?category={{ $item2->slug }}">
                                {{ $item2->name }} </a>
                        </h3>
                        @endif
                    
                        @endforeach
                    </div> 
                        @endif
                    
                    @endforeach
                </div>

            @endforeach
        </div>
    </div>



@stop

@extends('layouts.appseller')

@section('content')

 <div class="col-md-9">
    <?php echo displayAlert(); ?>

     <h3 class="title_name"> Edit Request </h3><br>

    <div class="row">
        <div class="col-sm-8">
               <form  action="{{ route('request.update') }}" method="post"  enctype="multipart/form-data">
                   @csrf
                            <input type="hidden" value="{{$request[0]['id']}}"  name="id">
                            <input type="hidden" value="{{$product[0]->unit}}" name="unit">

                            <p style="text-align: left; margin-bottom: 10px; font-weight: 600; color: var(--default-color); ">Quantity</p>
                            <div class="form-group number">

                                <span class="minus">-</span>
                                <input type="text" value="{{ $request[0]['req_quantity'] }}" name="req_quantity" autocomplete="off">
                                <span class="plus">+</span>
                            </div>

                            <div class="form-group">
                                <label>Volume</label>( {{ $product[0]->getunit($product[0]->unit)}} )
                                <input type="text" name="volume"  value="{{ $request[0]['volume'] }}" class="form-control" />

                            </div>


                            <div class="form-group" style="display: none;">
                                <label>Destination</label>
                                <textarea rows="2" name="port_of_destination"  cols="50" class="form-control"
                                          placeholder="Write about your destination">null</textarea>
                            </div>

                            <div class="form-group">
                                <label>Additional Information</label>
                                <textarea rows="2" name="description" cols="50" class="form-control" placeholder="Write about your  Additional information">
                                              {{ $request[0]['additional_information'] }}
                                </textarea>
                            </div>
                            <input type="hidden" value="{{$product[0]->name}}" name="product_name">
                            <a class="btn btn-success" href="{{ route('request.index') }}" >Back</a>
                            <button type="submit" class="btn btn-success">Update</button>

                        </form>
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="bulk-dealpanel">
                <div class="topimgsection">
                    <a href="{{ route('product.show', $product[0]->slug) }}" target="_blank">
                        <img src="{{ asset('uploads/') }}/{{ $product[0]->thumbnailUrl() }}" alt="img">
                    </a>
                </div>
                <div class="lowerTxtprt">
                    <h4></h4>
                    <h3><a href="{{ route('product.show', $product[0]->slug) }}" target="_blank">{{ $request[0]['product_name'] }}</a></h3>
                    <span> {{ $product[0]->price_from }} {{ $product[0]->getcurrency($product[0]->currency_id) }}/ <sub>{{ $product[0]->getunit($request[0]['unit']) }}</sub></span>
                    <small>{{ $product[0]->MOQ }} {{ $product[0]->getunit($request[0]['unit']) }} min order</small>
                    <a href="{{ route('product.show', $product[0]->slug) }}" target="_blank"> <button class="viewbtn">VIEW</button> </a>

                </div>
            </div>
        </div>
    </div>

  </div>

@stop

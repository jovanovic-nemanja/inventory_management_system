@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="bulk-dealpanel">
            <div class="topimgsection">
                <a href="{{ route('product.show', $product->slug) }}">
                    <img src="{{ asset('uploads/') }}/{{ $product->url }}" alt="img">
                </a>
            </div>
            <div class="lowerTxtprt">
                <h4>{{ $product->category_name }}</h4>

                <a title="{{ $product->name }}" href="{{ route('product.show', $product->slug) }}">
                    <h3 class="margin10">{{ str_limit(strip_tags(ucwords(strtolower($product->name))), 25) }}
                    </h3>
                </a>
                @if ($product->price_show == 1)
                    @if ($product->price_fixed == 1)
                        <span>
                            {{ $product->price_to }}{{ $product->currency_name }} /
                            <sub>{{ $product->unitname }}</sub>
                        </span>
                    @else
                        <span>
                            {{ $product->price_from }}{{ $product->currency_name }} -
                            {{ $product->price_to }}{{ $product->currency_name }} /
                            <sub>{{ $product->unitname }}</sub>
                        </span>
                    @endif
                @else
                    <span class="priceprtTxt">
                        <a href="{{ route('product.show', $product->slug) }}" style="color:#264b72;" target="_blank">
                            Ask For Price
                        </a>
                    </span>
                @endif


                <small>{{ $product->MOQ }} {{ $product->unitname }} min order</small>
                <p>{{ $product->company_name }}</p>

                <a href="{{ route('product.show', $product->slug) }}">
                    <button class="viewbtn">VIEW AND INQUIRE</button>
                </a>

            </div>
        </div>
    </div>
@endforeach

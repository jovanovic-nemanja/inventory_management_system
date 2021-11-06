@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Update Product</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/products') }}">Products</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"></div>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" action="{{ route('products.update') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Title:<sup>*</sup></label>

                                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                <input type="text" name="name" value="{{ $product->name }}"
                                                    placeholder="Product Title" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Category:<sup>*</sup></label>


                                                <select name="category_id" class="form-control myselect2">
                                                    <option value="">Please Select</option>
                                                    @foreach ($product_categories as $key => $category)
                                                        @if ($key == $product->category_id)
                                                            <option selected="" value="{{ $key }}">
                                                                {{ html_entity_decode($category) }}</option>
                                                        @else
                                                            <option value="{{ $key }}">
                                                                {{ html_entity_decode($category) }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Minimum Order Quantity:<sup>*</sup></label>
                                                <input name="MOQ" type="number" value="{{ $product->MOQ }}"
                                                    placeholder="Minimum Order Quantity" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Product Unit:<sup>*</sup></label>
                                                <select name="unit_id" class="form-control">
                                                    <option value="">Please Select</option>

                                                    @foreach ($units as $unit)
                                                        @if ($unit->id == $product->unit)
                                                            <option selected="" value="{{ $unit->id }}">
                                                                {{ $unit->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $unit->id }}">{{ $unit->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        @if ($product->price_show == 1)
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Do you want to show price ?</label>
                                                    <div class="radioprt">
                                                        <div class="listitem-check">
                                                            <input checked type="radio" class="product_price_show"
                                                                name="product_price_show" value="1">
                                                            <label onClick="">Yes</label>
                                                        </div>
                                                        <div class="listitem-check">
                                                            <input type="radio" class="product_price_show"
                                                                name="product_price_show" value="0">
                                                            <label onClick="">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($product->price_fixed == 1)
                                                <div class="col-sm-6">
                                                    <div id="price_ask" style="display:none;">
                                                        <span style="font-weight: bolder;font-size: 18px;color: #264b72;">
                                                            Ask For Price
                                                        </span>
                                                        will be appeared in price section
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" id="fixed_price">
                                                    <label>Price Type :</label>
                                                    <div class="radioprt">

                                                        <div class="listitem-check">
                                                            <input type="radio" id="range_show"
                                                                class="product_fixed_price_show"
                                                                name="product_fixed_price_show" value="0">
                                                            <label onClick="">Price Range</label>
                                                        </div>
                                                        <div class="listitem-check">
                                                            <input checked type="radio" id="fixed_show"
                                                                class="product_fixed_price_show"
                                                                name="product_fixed_price_show" value="1">
                                                            <label onClick="">Fixed Price</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="price_section" class="col-sm-6" style="display:none;">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Price From:<sup>*</sup></label>
                                                            <input id="price_from" name="price_from" type="number"
                                                                value="{{ $product->price_from }}" placeholder="0"
                                                                min="0" step="any" class="form-control price_check" />

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Price To:<sup>*</sup></label>
                                                            <input type="number" id="price_to" name="price_to"
                                                                value="{{ $product->price_to }}" required placeholder="0"
                                                                min="0" step="any" class="form-control price_check" />
                                                            <span id="price_to_error" style="display: none;"
                                                                class="text-danger">Price To
                                                                must
                                                                be
                                                                greater or equal than Price From</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="fixed_price_section" class="col-sm-6" style="display:contents;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Fixed Price :<sup>*</sup></label>
                                                            <input type="number" id="price_to" name="price_to"
                                                                value="{{ $product->price_to }}" required placeholder="0"
                                                                min="0" step="any" class="form-control price_check" />
                                                            <span id="price_to_error" style="display: none;"
                                                                class="text-danger">Price To
                                                                must
                                                                be greater or equal than Price From</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div id="price_ask" style="display:none;">
                                                            <span
                                                                style="font-weight: bolder;font-size: 18px;color: #264b72;">
                                                                Ask For Price
                                                            </span>
                                                            will be appeared in price section
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" id="fixed_price">
                                                    <div class="form-group">
                                                        <label>Price Type :</label>
                                                        <div class="radioprt">
                                                            <div class="listitem-check">
                                                                <input checked type="radio" id="range_show"
                                                                    class="product_fixed_price_show"
                                                                    name="product_fixed_price_show" value="0">
                                                                <label onClick="">Price Range</label>
                                                            </div>
                                                            <div class="listitem-check">
                                                                <input type="radio" id="fixed_show"
                                                                    class="product_fixed_price_show"
                                                                    name="product_fixed_price_show" value="1">
                                                                <label onClick="">Fixed Price</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="price_section" class="col-sm-6" style="display:contents;">

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Price From:<sup>*</sup></label>
                                                            <input id="price_from" name="price_from" type="number"
                                                                value="{{ $product->price_from }}" placeholder="0"
                                                                min="0" step="any" class="form-control price_check" />

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Price To:<sup>*</sup></label>
                                                            <input type="number" id="price_to" name="price_to"
                                                                value="{{ $product->price_to }}" required placeholder="0"
                                                                min="0" step="any" class="form-control price_check" />
                                                            <span id="price_to_error" style="display: none;"
                                                                class="text-danger">Price To
                                                                must
                                                                be greater or equal than Price From</span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="fixed_price_section" class="col-sm-6" style="display:none;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>Fixed Price :<sup>*</sup></label>
                                                                <input type="number" id="price_to" name="price_to"
                                                                    value="{{ $product->price_to }}" required
                                                                    placeholder="0" min="0" step="any"
                                                                    class="form-control price_check" />
                                                                <span id="price_to_error" style="display: none;"
                                                                    class="text-danger">Price
                                                                    To
                                                                    must
                                                                    be greater or equal than Price From</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif

                                        @else
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Do you want to show price?</label>
                                                    <div class="radioprt">
                                                        <div class="listitem-check">
                                                            <input type="radio" class="product_price_show"
                                                                name="product_price_show" value="1">
                                                            <label onClick="">Yes</label>
                                                        </div>
                                                        <div class="listitem-check">
                                                            <input checked type="radio" class="product_price_show"
                                                                name="product_price_show" value="0">
                                                            <label onClick="">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">

                                                <div id="price_ask" style="display:block;">
                                                    <span style="font-weight: bolder;font-size: 18px;color: #264b72;">
                                                        Ask For Price
                                                    </span>
                                                    will show
                                                </div>
                                            </div>
                                            <div class="col-sm-6" id="fixed_price" style="display:none;">
                                                <div class="form-group">
                                                    <label>Price Type :</label>
                                                    <div class="radioprt">

                                                        <div class="listitem-check">
                                                            <input type="radio" id="range_show"
                                                                class="product_fixed_price_show"
                                                                name="product_fixed_price_show" value="0">
                                                            <label onClick="">Price Range</label>
                                                        </div>
                                                        <div class="listitem-check">
                                                            <input checked type="radio" id="fixed_show"
                                                                class="product_fixed_price_show"
                                                                name="product_fixed_price_show" value="1">
                                                            <label onClick="">Fixed Price</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="price_section" class="col-sm-6" style="display:none;">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Price From:<sup>*</sup></label>
                                                        <input id="price_from" name="price_from" type="number"
                                                            value="{{ $product->price_from }}" placeholder="0" min="0"
                                                            step="any" class="form-control price_check" />

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Price To:<sup>*</sup></label>
                                                        <input type="number" id="price_to" name="price_to"
                                                            value="{{ $product->price_to }}" required placeholder="0"
                                                            min="0" step="any" class="form-control price_check" />
                                                        <span id="price_to_error" style="display: none;"
                                                            class="text-danger">Price
                                                            To must
                                                            be
                                                            greater or equal than Price From</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="fixed_price_section" class="col-sm-6" style="display:none;">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fixed Price :<sup>*</sup></label>
                                                        <input type="number" id="price_to" name="price_to"
                                                            value="{{ $product->price_to }}" required placeholder="0"
                                                            min="0" step="any" class="form-control price_check" />
                                                        <span id="price_to_error" style="display: none;"
                                                            class="text-danger">Price
                                                            To must
                                                            be
                                                            greater or equal than Price From</span>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif





                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Currency:<sup>*</sup></label>
                                                <select name="currency_id" class="form-control">
                                                    <option value="">Please Select</option>

                                                    @foreach ($currencies as $currency)
                                                        @if ($currency->id == $product->currency_id)
                                                            <option selected="" value="{{ $currency->id }}">
                                                                {{ $currency->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $currency->id }}">{{ $currency->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description:<sup>*</sup></label>
                                                <textarea name="description" rows="4" cols="50"
                                                    class="form-control ckeditor" placeholder="Write Description...">
                                                                                                                                                                                                                                                                                                                                                                  {{ $product->description }}
                                                                                                                                                                                                                                                                                                                                                        </textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Meta Title:<sup>*</sup></label>
                                                <input name="meta_title" required="" type="text"
                                                    value="{{ $product->meta_title }}" placeholder="Meta Title"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Meta Keywords:<sup>*</sup></label>
                                                <input name="meta_keywords" required="" type="text"
                                                    value="{{ $product->meta_keywords }}" placeholder="Meta Keywords"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Video URL (please use embedded link ):</label>
                                                <input name="video_link" type="text" value="{{ $product->video_link }}"
                                                    placeholder="URL sholud contain https" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Meta Description:</label>

                                                <textarea name="meta_description" required="" rows="4" cols="50"
                                                    class="form-control ckeditor" placeholder="Write Meta Description...">
                                                                                                                                                                                                                                                                                                                                                        {{ $product->meta_description }}
                                                                                                                                                                                                                                                                                                                                                        </textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Product Image:<sup>*</sup></label>
                                                <p>Image type :jpg,jpeg,png and Image size : 2 mb</p>
                                                <input type="file" name="single" id="gallery-photo-add"
                                                    class="form-control" />
                                                <div class="gallery">
                                                    <img class="img-fluid" width="200"
                                                        src="{{ asset('uploads/') }}/{{ $product->image_url }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Additional Images:</label>
                                                @foreach ($allimages as $img)
                                                    @if ($img->url != $product->image_url)
                                                        <div id="previd{{ $img->id }}">
                                                            <img class="img-fluid" width="100"
                                                                src="{{ asset('uploads/') }}/{{ $img->url }}">
                                                            <button type="button"
                                                                class="btn btn-success btn-sm delete-image"
                                                                id="{{ $img->id }}">Delete</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                                            </div>
                                        </div>


                                    </div>
                                    <button class="btn btn-success" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

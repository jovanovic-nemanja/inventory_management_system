@extends('layouts.appseller')

@section('content')

    <div class="col-md-9">
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('flash'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    {{ Session::get('flash') }}
                </ul>
            </div>

        @endif
        <div class="formPrtt">
            <h2>Add Product</h2>
            <form method="post" enctype="multipart/form-data" action="{{ route('product.upload') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Title:<sup>*</sup></label>
                            <input type="text" required="" name="name" placeholder="Product Title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category:<sup>*</sup></label>
                            <select name="category_id" required class="form-control myselect2">
                                <option value="">Please Select</option>
                                @foreach ($product_categories as $key => $category)
                                    <option value="{{ $key }}">{{ html_entity_decode($category) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Minimum Order Quantity:<sup>*</sup></label>
                            <input type="number" name="MOQ" required placeholder="0" min="0" class="form-control" />
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Product Unit:<sup>*</sup></label>
                            <select name="unit_id" required class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($units as $unit)

                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Do you want to show price ?</label>
                            <div class="radioprt">
                                <div class="listitem-check">
                                    <input type="radio" class="product_price_show" checked name="product_price_show"
                                        value="1">
                                    <label onClick="">Yes</label>
                                </div>
                                <div class="listitem-check">
                                    <input type="radio" class="product_price_show" name="product_price_show" value="0">
                                    <label onClick="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="price_ask" style="display:none;">
                            <span style="font-weight: bolder;font-size: 18px;color: #264b72;">
                                Ask For Price
                            </span>
                            will be appeared in price section
                        </div>
                    </div>
                    <div class="col-sm-6" id="fixed_price">
                        <div class="form-group">
                            <label>Price Type :</label>
                            <div class="radioprt">
                                <div class="listitem-check">
                                    <input checked type="radio" id="range_show" class="product_fixed_price_show"
                                        name="product_fixed_price_show" value="0">
                                    <label onClick="">Price Range</label>
                                </div>
                                <div class="listitem-check">
                                    <input type="radio" id="fixed_show" class="product_fixed_price_show"
                                        name="product_fixed_price_show" value="1">
                                    <label onClick="">Fixed Price</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="price_section" style="display:contents;" class="col-sm-6">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Price From:<sup>*</sup></label>
                                <input type="number" id="price_from" name="price_from" value="0" placeholder="0" min="0"
                                    step="any" class="form-control price_check" />
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Price To:<sup>*</sup></label>
                                <input type="number" id="price_to" name="price_to" placeholder="0" value="0" min="0"
                                    step="any" class="form-control price_check" />
                                <span id="price_to_error" style="display: none;" class="text-danger">Price To must be
                                    greater or equal than Price From</span>
                            </div>
                        </div>
                    </div>


                    <div id="fixed_price_section" style="display:none;" class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Price :<sup>*</sup></label>
                                <input type="number" id="price_fixed" placeholder="0" min="0" step="any"
                                    class="form-control price_check" />
                                <span id="price_to_error" style="display: none;" class="text-danger">Price To must be
                                    greater or equal than Price From</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Currency:<sup>*</sup></label>
                            <select name="currency_id" required class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($currencies as $currency)

                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12" id="prod_des">
                        <div class="form-group">
                            <label> Description: <sup>*</sup></label>
                            <textarea rows="4" id="prod_description" name="description" cols="50"
                                class="form-control ckeditor" placeholder="Write Description..."
                                required="required"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta Title:<sup>*</sup></label>
                            <input type="text" required name="meta_title" required placeholder="Meta Title"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta Keywords:<sup>*</sup></label>
                            <input type="text" required placeholder="Meta Keywords" class="form-control"
                                name="meta_keywords" required placeholder="Meta Keywords" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Video URL (please use embedded link ):</label>
                            <input name="video_link" type="text" placeholder="URL sholud contain https"
                                class="form-control" />
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta Description:</label>
                            <textarea rows="4" name="meta_description" cols="50" class="form-control ckeditor"
                                placeholder="Write Meta Description..."></textarea>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Product Image:<sup>*</sup></label>
                            <p>Image type :jpg,jpeg,png and Image size : 2 mb</p>
                            <input type="file" id="gallery-photo-add" required="" name="single" class="form-control" />
                        </div>
                        <div class="gallery"></div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Additional Images:</label>
                            <!--<input type="file" class="form-control" />-->
                            <!--<input type="file" name="addimages[]" multiple="true" class="form-control" />-->
                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                        </div>
                    </div>


                </div>
                <button class="btn margin20" id="product_submit" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

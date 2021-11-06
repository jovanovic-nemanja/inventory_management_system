@extends('layouts.appseller')

@section('content')

    <div class="col-md-9">

        <div class="formPrtt">
            <h3>Add Product</h3>
            <form method="post" enctype="multipart/form-data" action="{{ route('product.upload') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" required="" name="name" placeholder="Product Title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category:</label>
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
                            <label>Minimum Order Quantity:</label>
                            <input type="number" name="MOQ" required placeholder="0" min="0" class="form-control" />
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Product Unit:</label>
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
                                <label>Price From:</label>
                                <input type="number" id="price_from" name="price_from" required placeholder="0" min="0"
                                    step="any" class="form-control price_check" />
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Price To:</label>
                                <input type="number" id="price_to" name="price_to" required placeholder="0" min="0"
                                    step="any" class="form-control price_check" />
                                <span id="price_to_error" style="display: none;" class="text-danger">Price To must be
                                    greater or equal than Price From</span>
                            </div>
                        </div>
                    </div>


                    <div id="fixed_price_section" style="display:none;" class="col-sm-6">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Price :</label>
                                <input type="number" id="price_fixed" name="price_to" required placeholder="0" min="0"
                                    step="any" class="form-control price_check" />
                                <span id="price_to_error" style="display: none;" class="text-danger">Price To must be
                                    greater or equal than Price From</span>
                            </div>
                        </div>
                    </div>






                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Currency:</label>
                            <select name="currency_id" required class="form-control">
                                <option value="">Please Select</option>
                                @foreach ($currencies as $currency)

                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea rows="4" name="description" required cols="50" class="form-control ckeditor"
                                placeholder="Write Description..."></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta Title:</label>
                            <input type="text" name="meta_title" placeholder="Meta Title" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Meta Keywords:</label>
                            <input type="text" name="meta_keywords" placeholder="Meta Keywords" class="form-control" />
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
                            <label>Product Image:</label>
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
                <button class="btn margin20" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

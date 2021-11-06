@extends('layouts.appseller')

@section('content')
    <div class="col-md-9">
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
        <div class="datatablestructure">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ __('My Product') }}</h3>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    @if ($user_status == 0)
                        <a class="btn btn-success" href="{{ route('product.create') }}">
                            Add Product
                        </a>
                    @endif

                    @if ($user_status == 1)
                        <p style="color: red;">Your account was blocked by admin!</p>
                    @endif
                </div>
            </div>

            <br>
            <input type="hidden" class="url" value="{{ Route('products.deleteproductsbychoosing') }}" />
            <input type="hidden" class="checkVals" />

            <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        {{-- <th><input type='checkbox' id="selectAll" /></th> --}}
                        <th>SL</th>
                        <th>Product Name</th>
                        <!-- <th width="10%">Date</th> -->
                        <th>Image</th>
                        <th>Status</th>
                        @if ($user_status == 0)
                            <th>Action</th>
                        @endif

                        @if ($user_status == 1)
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ ucwords(strtolower($product->name)) }}</td>
                            <td>
                                @if (@$product->image_url)
                                    <img class="img-fluid" width="100"
                                        src="{{ asset('uploads/') }}/{{ $product->image_url }}" alt="">
                                @else
                                @endif
                            </td>
                            <td>
                                {{ $product->getstatuesname($product->status) }}
                            </td>


                            <td style="white-space: nowrap; border-top: none;">
                                <a class="btn btn-success" target="_blank"
                                    href="{{ route('product.show', $product->slug) }}">{{ __('View') }}</a>



                                @if ($product->status != 3)
                                    <a class="btn btn-success"
                                        href="{{ route('product.edit', $product->slug) }}">{{ __('Edit') }}</a>
                                    <button class="btn btn-danger productdelete"
                                        id="{{ $product->slug }}">Delete</button>
                                @endif
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
    <br>
    <br>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var alls = $('#order-listing tbody').children();
            $('body').on('click', '#selectAll', function() {
                if ($(this).hasClass('allChecked')) {
                    $('input[type="checkbox"]', alls).prop('checked', false);
                    $('.checkVals').val('');
                    $('.submit_checkbox').remove();
                } else {
                    $('input[type="checkbox"]', alls).prop('checked', true);
                    var ids = [];
                    $('#order-listing input:checked').each(function() {
                        if ($(this).attr('id') == 'selectAll') {

                        } else
                            ids.push($(this).val());
                    });
                    $('.checkVals').val(ids);
                    $('#order-listing_filter label').after(
                        '<button class="ps-btn submit_checkbox" style="padding: 15px 30px; margin-left: 2%;">Delete</button>'
                    );
                }
                $(this).toggleClass('allChecked');
                $('.submit_checkbox').click(function() {
                    submitcheck();
                });
            })
        });

        function submitcheck() {
            var ids = $('.checkVals').val();
            if (!ids) {
                alert('There are not any chosen items now.');
                return;
            }

            var href = $('.url').val();
            $.ajax({
                url: href,
                type: 'GET',
                data: {
                    ids: ids
                },
                success: function(result, status) {
                    if (result.status == 200) {
                        window.location.href = window.location.href;
                    } else {
                        alert(result.msg);
                    }
                }
            })
        };

    </script>
@endsection

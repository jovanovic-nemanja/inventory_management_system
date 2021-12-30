@extends('layouts.inventorynowrap', ['menu' => 'container'])

@section('content')
    <style>
        table {
            border: 1px solid #999;
            border-collapse: collapse;
            width: 100%
        }

        td {
            border: 1px solid #999
        }

        .table td,
        .table th {
            padding: 5px !important;
        }

    </style>

    <?php echo displayAlert(); ?>

    <div class="page-header pt-3">
        <h3 class="page-title"> {{ $batch->name }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container') }}">Container List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
        </nav>
    </div>

    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('product.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="batch_id" value="{{ $batch->id }}" />

                        <div class="accordion" id="accordion" role="tablist">
                            @php
                                $increment = 1;
                                $tbl_inc = 1;
                                $td_inc = 1;
                            @endphp
                            @foreach ($allcategory as $cus)
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading-{{ $cus->id }}">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapse-{{ $cus->id }}" aria-expanded="false" aria-controls="collapse-{{ $cus->id }}"> {{ $cus->name }} </a>
                                        </h6>
                                    </div>

                                    <div id="collapse-{{ $cus->id }}" class="collapse"
                                        aria-labelledby="heading-{{ $cus->id }}" data-parent="#accordion">
                                        <div class="card-body table-responsive">
                                            <table class="table table-head-bg-success" id="myTable_{{ $increment }}" style="text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Product</th>

                                                        @php
                                                            $counts = count(App\Mark::where('container_id', $container->id)->get());
                                                        @endphp
                                                        <th scope="col" colspan="<?= $counts + 1 ?>"
                                                            style="text-align: center; border: 1px solid #999 !important;">
                                                            {{ $container->owner_name }}</th>

                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Cost</th>

                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Price</th>
                                                        
                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Vat</th>

                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Vat Price</th>

                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Total Price</th>

                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Profit</th>
                                                        
                                                        <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;">Total Profit</th>

                                                        <!-- <th scope="col" rowspan="2"
                                                            style="border: 1px solid #999 !important;"></th> -->
                                                    </tr>
                                                    <tr>
                                                        @foreach ($allmarks as $mark)
                                                            <th scope="col">{{ $mark->name }}</th>
                                                        @endforeach
                                                        <th scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (@$allproductdetail)
                                                        @foreach ($allproductdetail as $prod)
                                                            @if ($prod->category_id == $cus->id)
                                                                @if($prod->initial_stock > 0)
                                                                    @if (isset($allmarkdetail[$tbl_inc - 1]))
                                                                        @php
                                                                            $total = 0;
                                                                            $markinc = 1;
                                                                            $incMarkData = $allmarkdetail[$tbl_inc - 1]['mark_data'];
                                                                            $incMarkData = json_decode($incMarkData);
                                                                            $countOfprev = $prev_count;
                                                                        @endphp

                                                                        @foreach ($allmarks as $key => $mark)
                                                                            @php
                                                                                $makrval = $incMarkData[$markinc - 1 + $countOfprev];
                                                                                $total = $total + $makrval;
                                                                            @endphp

                                                                            @php
                                                                                $td_inc++;
                                                                                $markinc++;
                                                                            @endphp
                                                                        @endforeach

                                                                        @if($total > 0)
                                                                            <tr id="row_{{ $tbl_inc }}"
                                                                                class="getRow">
                                                                                <td>
                                                                                    <label>{{ $prod->product_name }}</label>
                                                                                    <input type="hidden" name="prodName[]"
                                                                                        value="{{ $prod->product_id }}" />
                                                                                    <input type="hidden" name="cat_id[]"
                                                                                        value="{{ $prod->category_id }}" />
                                                                                </td>
                                                                                <input type="hidden" name="initial_stock[]"
                                                                                    class="iStock_{{ $tbl_inc }}"
                                                                                    value="{{ $prod->initial_stock }}" />

                                                                                @if (isset($allmarkdetail[$tbl_inc - 1]))
                                                                                    @php
                                                                                        $markinc = 1;
                                                                                        $incMarkData = $allmarkdetail[$tbl_inc - 1]['mark_data'];
                                                                                        $incMarkData = json_decode($incMarkData);
                                                                                        $countOfprev = $prev_count;
                                                                                        
                                                                                    @endphp
                                                                                    @foreach ($allmarks as $key => $mark)
                                                                                        @php
                                                                                            $makrval = $incMarkData[$markinc - 1 + $countOfprev];
                                                                                            $total = $total + $makrval;
                                                                                        @endphp

                                                                                        <td>
                                                                                            <label>{{ $makrval }}</label>
                                                                                            <input type="hidden"
                                                                                                value="{{ $makrval }}"
                                                                                                name="mark_{{ $key + 1 + count($allmarks) * ($prod->product_id - 1) }}"
                                                                                                class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                                        </td>
                                                                                        @php
                                                                                            $td_inc++;
                                                                                            $markinc++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                    <td><label>{{ $total }}</label></td>
                                                                                @else
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            name="mark_{{ $td_inc }}"
                                                                                            class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                                    </td>
                                                                                @endif

                                                                                <td>
                                                                                    <label>{{ number_format(round($prod->cost, 0, PHP_ROUND_HALF_UP), 2) }}</label>
                                                                                    <input type="hidden" class="form-control"
                                                                                        name="cost[]"
                                                                                        value="{{ $prod->cost }}" />
                                                                                </td>
                                                                                <td>
                                                                                    @php
                                                                                        $item = App\BatchProdPrices::where('batch_prod_id', $prod->id)->where('container_id', $container->id)->first();
                                                                                        if (@$item) {
                                                                                            $price = $item->price;
                                                                                            $vat = ($item->vat == 1) ? 0 : 5;
                                                                                            $vt = $item->vat;
                                                                                        }else{
                                                                                            $price = 0;
                                                                                            $vat = 0;
                                                                                            $vt = 1;
                                                                                        }

                                                                                        $vat_price = $vat * $price / 100;
                                                                                        $total_price = $vat_price + $price;
                                                                                        $profit = $total_price - $prod->cost;
                                                                                        $total_profit = $profit * $total;
                                                                                    @endphp

                                                                                    <input type="text" class="form-control"
                                                                                        name="price[]"
                                                                                        value="{{ $price }}" />
                                                                                </td>

                                                                                <td>
                                                                                    <select class="form-control" name="vat[]">
                                                                                        <option value="1" <?php if($vt == 1) { echo "selected"; } ?>>0%</option>
                                                                                        <option value="2" <?php if($vt == 2) { echo "selected"; } ?>>5%</option>
                                                                                    </select>
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text" class="form-control" name="vat_price[]" value="{{ number_format(round($vat_price, 0, PHP_ROUND_HALF_UP), 2) }}" readonly />
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text" class="form-control" name="total_price[]" value="{{ number_format(round($total_price, 0, PHP_ROUND_HALF_UP), 2) }}" readonly />
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text" class="form-control" name="profit[]" value="{{ number_format(round($profit, 0, PHP_ROUND_HALF_UP), 2) }}" readonly />
                                                                                </td>

                                                                                <td>
                                                                                    <input type="text" class="form-control" name="total_profit[]" value="{{ number_format(round($total_profit, 0, PHP_ROUND_HALF_UP), 2) }}" readonly />
                                                                                </td>

                                                                                <input type="hidden"
                                                                                    class="form-control stock_{{ $tbl_inc }}"
                                                                                    name="stock[]"
                                                                                    value="{{ $prod->after_stock }}" />

                                                                                <!-- <td>
                                                                                    <button type="button"
                                                                                        onclick="deleteTblRow(this)"
                                                                                        class="btn btn-sm btn-danger">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>
                                                                                </td> -->
                                                                            </tr>
                                                                        @endif
                                                                    @endif

                                                                    @php
                                                                        $tbl_inc++;
                                                                    @endphp
                                                                @endif        
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $increment++;
                                @endphp
                            @endforeach
                        </div>

                        <div class="pt-5">
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Update</button>

                                <a href="{{ route('container.downloadPDF', [$container->id, $batch->id]) }}" class="btn btn-warning pull-right">
                                    <i class="fas fa-file-pdf"></i> Download Loading List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('custom/inventory.js') }}"></script>
@endsection
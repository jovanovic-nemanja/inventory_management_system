@extends('layouts.inventory', ['menu' => 'customer'])

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

<div class="page-header">
    <h3 class="page-title"> Customer Expense </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/customer') }}">Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customer Expense</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h3> Customer : {{ $customer->name }}
                    </h3>
                </div>
                <div class="d-flex align-items-center">
                    <h3>
                        Fund : {{ number_format( $customer->current_balance,2) }} AED
                    </h3>
                </div>
                <div class="d-flex align-items-center">
                    <h3 id="expense">
                        Expense :
                    </h3>
                </div>
                <div class="d-flex align-items-center">
                    <h3 id="balance">
                        Balance :
                    </h3>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-12">
                <div class="accordion" id="accordion" role="tablist">
                    @php
                        $increment = 1;
                        $tbl_inc = 1;
                        $td_inc = 1;
                        $total_expense = 0;
                    @endphp

                    @foreach ($allcontainer as $cus)
                        @php
                            $container_total = 0;
                        @endphp

                        <div class="card">
                            <div class="card-header" role="tab" id="heading1{{ $cus->container_id }}">
                                <h6 class="mb-0 justify-content-between d-flex">
                                    <a style="padding-right: 45%;" data-toggle="collapse" href="#collapse1{{ $cus->container_id }}" aria-expanded="false" aria-controls="collapse1{{ $cus->container_id }}" class="collapsed"> Container ID : {{ $cus->con_name }} 
                                        <span class="ml-auto"
                                            style="font-size: 25px;"
                                            id="container_amount_{{ $cus->con_name }}">
                                        </span> 
                                    </a>
                                    <div class="d-flex">
                                        <a href="{{ route('customer.invoice', $customer->id) }}" target="_blank">Invoice</a>
                                        <a href="{{ route('customer.consolidate', [$customer->id, $cus->container_id]) }}" target="_blank">Consolidate</a>
                                    </div>
                                </h6>
                            </div>
                            <div id="collapse1{{ $cus->container_id }}" class="collapse" role="tabpanel" aria-labelledby="heading1{{ $cus->container_id }}" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="accordion" id="accordions{{ $cus->container_id }}" role="tablist">
                                        @foreach ($allmark as $mark)
                                            @if ($mark->container_id == $cus->container_id)
    
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="heading{{ $mark->id }}">
                                                        <h6 class="mb-0">
                                                            <a style="padding-right: 45%;" data-toggle="collapse" href="#collapse{{ $mark->id }}" aria-expanded="false" aria-controls="collapse{{ $mark->id }}" class="collapsed"> Mark : {{ $mark->name }}</a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapse{{ $mark->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $mark->id }}" data-parent="#accordions{{ $cus->container_id }}">
                                                        <div class="card-body">
                                                            <table class="table table-head-bg-success"
                                                                id="myTable_{{ $increment }}">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Product</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Total Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $grand_total = 0;
                                                                    @endphp
                                                                    @foreach ($allproduct as $product)
                                                                        
                                                                        @php
                                                                            $makr_total = 0;
                                                                            $makr_value = 0;
                                                                        @endphp
                                                                        @php
                                                                            $chkid = json_decode($product->all_mark_id);
                                                                            $chkval = json_decode($product->all_mark_data);
                                                                        @endphp
                                                                        @if (!@empty($chkid ))
                                                                            @foreach ($chkid as $key => $value)
                                                                                @if ($mark->id == $value->id)
                                                                                    @php
                                                                                        $makr_value = $chkval[$key];
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                        @php
                                                                            $init_price = App\BatchProdPrices::where('batch_prod_id', $product->product_id)->where('container_id', $cus->container_id)->first();
                                                                            if (@$init_price) {
                                                                                $makr_total += $makr_value * $init_price->price;
                                                                                $price = $init_price->price;
                                                                            }else{
                                                                                $makr_total += 0;
                                                                                $price = 0;
                                                                            }
                                                                            
                                                                            $grand_total += $makr_total;
                                                                        @endphp
    
                                                                        @if ($makr_value > 0)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $product->product_name }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $makr_value }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format($price, 2) }} AED
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format($makr_total,2) }} AED
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    <tr>
                                                                        <td style="text-align: right; font-size:25px; font-weight:600;"
                                                                            colspan='3'>Total
                                                                        </td>
                                                                        <td
                                                                            style="text-align: left; font-size:25px; font-weight:600;">
                                                                            {{number_format($grand_total,2)}} AED
                                                                            @php
                                                                                $container_total += $grand_total;
                                                                            @endphp
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" data-id="{{ $cus->con_name }}" class="container_total" name="container_total_{{ $cus->con_name }}" id="container_total_{{ $cus->con_name }}" value="{{$container_total}}">
                        
                        @php
                            $increment++;
                            $total_expense += $container_total;
                        @endphp
                    @endforeach

                    <input type="hidden" id="customer_expense" value="{{$total_expense}}" />
                    <input type="hidden" id="current_balance" value="{{$customer->current_balance}}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

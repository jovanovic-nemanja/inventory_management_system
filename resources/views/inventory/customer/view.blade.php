@extends('layouts.inventory')

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
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Customer Expense</h4>
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
                        <a href="">Customer Expense</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-space">
                            <div class="card-header">
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

                            <div class="accordion accordion-secondary">
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
                                    <div class="card-header collapsed" id="heading1{{ $cus->container_id }}"
                                        data-toggle="collapse" data-target="#collapse1{{ $cus->container_id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $cus->container_id }}"
                                        role="button">
                                        <div class="span-icon">
                                            <div class="flaticon-box-1"></div>
                                        </div>
                                        <div class="span-title">
                                            Container ID : {{ $cus->con_name }} <span class="ml-auto"
                                                style="font-size: 25px;"
                                                id="container_amount_{{ $cus->con_name }}"></span>
                                        </div>
                                        <div class="span-mode"></div>
                                        <a href="{{ route('customer.invoice', $customer->id) }}" target="_blank">Invoice</a>
                                        <a href="{{ route('customer.consolidate', [$customer->id,$cus->container_id]) }}" target="_blank">Consolidate</a>
                                    </div>

                                    <div id="collapse1{{ $cus->container_id }}" class="collapse"
                                        aria-labelledby="heading1{{ $cus->container_id }}"
                                        data-parent="#accordion{{ $cus->container_id }}">
                                        <div class="card-body">
                                            @foreach ($allmark as $mark)
                                            @if ($mark->container_id == $cus->container_id)

                                            <div class="card">
                                                <div class="card-header collapsed" id="heading{{ $mark->id }}"
                                                    data-toggle="collapse" data-target="#collapse{{ $mark->id }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $mark->id }}"
                                                    role="button">
                                                    <div class="span-icon">
                                                        <div class="flaticon-box-1"></div>
                                                    </div>
                                                    <div class="span-title">
                                                        Mark : {{ $mark->name }}
                                                    </div>
                                                    <div class="span-mode"></div>
                                                </div>

                                                <div id="collapse{{ $mark->id }}" class="collapse"
                                                    aria-labelledby="heading{{ $mark->id }}"
                                                    data-parent="#accordion{{ $mark->id }}">
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
                                                                $makr_total += $makr_value * $product->price_value;
                                                                $grand_total += $makr_total;
                                                                @endphp




                                                                {{-- echo '<pre>'; print_r($chkid);echo '-';
                                                                                echo '<pre>'; print_r($chkid[0]->id);
                                                                                    echo '<pre>'; print_r($chkval);echo '-';
                                                                                     echo '-'; echo '<pre>';
                                                                                        print_r($mark->id); --}}

                                                                {{-- @if ($chkid[0]->id == $mark->id) --}}
                                                                @if ($makr_value>0)
                                                                <tr>
                                                                    <td>
                                                                        {{ $product->product_name }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $makr_value }}
                                                                    </td>
                                                                    <td>
                                                                        {{ number_format($product->price_value,2) }} AED
                                                                    </td>
                                                                    <td>
                                                                        {{ number_format($makr_total,2) }} AED
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                <tr>
                                                                    <td style="text-align: right; font-size:25px; font-weight:600;"
                                                                        colspan=3>Total
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
                                <input type="hidden" data-id="{{ $cus->con_name }}" class="container_total"
                                    name="container_total_{{ $cus->con_name }}"
                                    id="container_total_{{ $cus->con_name }}" value="{{$container_total}}">
                                @php
                                $increment++;
                                $total_expense += $container_total;
                                @endphp
                                @endforeach

                            </div>
                            <input type="hidden" id="customer_expense" value="{{$total_expense}}">
                            <input type="hidden" id="current_balance" value="{{$customer->current_balance}}">
                            {{-- <div class="card-footer">
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button class="btn btn-danger pull-right">Lock Container</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>


@endsection

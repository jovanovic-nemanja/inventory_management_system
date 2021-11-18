@extends('layouts.inventory', ['menu' => 'customer'])

@section('content')
    <style>
        table {
            border: 1px solid #999;
            border-collapse: collapse;
            width: 100%
        }

        td, th {
            border: 1px solid #999
        }

        .table td,
        .table th {
            padding: 5px !important;
        }

    </style>

    <?php echo displayAlert(); ?>

    <div class="page-header">
        <h3 class="page-title"> Container Invoice </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/customer') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Container Invoice</li>
            </ol>
        </nav>
    </div>

    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn  btn-success" id="makePdf">PDF</button>
                    <div id="invoicePdf">
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <img src="{{ asset('inventory/inventory_logo.png') }}" style="width: 60%; margin-left:18%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-space">
                                        <p style="font-size: 24px; text-align:right; font-weight:600;"> Customer : {{ $customer->name }}</p>
                                        <p style="font-size: 18px; text-align:right;"> Date : {{ date('d M Y') }}</p>
                                        <div class="accordion">
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
                                                    Container ID : {{ $cus->con_name }} <span class="ml-auto"
                                                        style="font-size: 25px;"
                                                        id="container_amount_{{ $cus->con_name }}"></span>
                                                    <input type="hidden" id="pdfName" value="Invoice Conatiner-{{ $cus->con_name }}">
                                                </div>

                                                @foreach ($allmark as $mark)
                                                    @if ($mark->container_id == $cus->container_id)
                                                        <div class="pb-5">
                                                            <div class="span-title">
                                                                Mark : {{ $mark->name }}
                                                            </div>

                                                            <table class="table"
                                                                id="myTable_{{ $increment }}">
                                                                <thead>
                                                                    <tr class="table-success">
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
                                                                        @if (!@empty($chkid))

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

                                                                        @if ($makr_value > 0)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $product->product_name }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $makr_value }}
                                                                                </td>
                                                                                <td>
                                                                                    {{number_format( $product->price_value,2) }} AED
                                                                                </td>
                                                                                <td>
                                                                                    {{number_format($makr_total,2) }} AED
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
                                                                            {{ number_format($grand_total,2) }} AED
                                                                            @php
                                                                                $container_total += $grand_total;
                                                                            @endphp

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            
                                                <input type="hidden" data-id="{{ $cus->con_name }}" class="container_total"
                                                    name="container_total_{{ $cus->con_name }}" id="container_total_{{ $cus->con_name }}"
                                                    value="{{ $container_total }}" />
                                                    
                                                @php
                                                    $increment++;
                                                    $total_expense += $container_total;
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="customer_expense" value="{{ $total_expense }}">
                                <input type="hidden" id="current_balance" value="{{ $customer->current_balance }}">
                            </div>

                            <hr style="5px solid rgba(0,0,0,.1);">

                            <p style="text-align: center; color:#00713e">
                                TEL:+971528390265/+97155-9750341/+97150-2583726,P.O.Box: 42467, Office N.E-76G-30
                                <br>
                                Hamriya Free Zone,Sharja-U.A.E., E-mail:greenflagexport@gmail.com / greenflag@yahoo.com
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                    <h4 class="page-title">Container Invoice</h4>
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
                            <a href="">Container Invoice</a>
                        </li>
                    </ul>
                </div>
                <button class="btn  btn-success" id="makePdf">PDF</button>
                <div id="invoicePdf">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <img src="{{ asset('inventory/inventory_logo.png') }}" style="width: 60%; margin-left:18%;">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <p style="font-size: 24px; text-align:right; font-weight:600;"> Customer : {{ $customer->name }}</p>
                                <p style="font-size: 18px; text-align:right;"> Date : {{ date('d M Y') }}</p>
                                <div class="accordion accordion-secondary">
                                    @php
                                        $increment = 1;
                                        $tbl_inc = 1;
                                        $td_inc = 1;
                                        $total_expense = 0;
                                        $totalQty = 0;
                                        $allmrkValTtl = 0;
                                        $allmrkTtl = array();
                                        $finalMrkTotal = 0;
                                    @endphp
                                    @foreach ($allcontainer as $cus)
                                        @php
                                            $container_total = 0;
                                        @endphp
                                        <div class="card">
                                            Container ID : {{ $cus->con_name }}
                                            <input type="hidden" id="pdfName" value="Consolidate Invoice for Conatiner-{{ $cus->con_name }}">
                                        </div>

                                                    @foreach ($allcategory as $cat)

                                                            @php

                                                            $chk = 0;
                                                            $chkval = array();

                                                        $grand_total = 0;
                                                        $totalQty = 0;
                                                        $mrkVal = 0;
                                                        $mrkTtl = array();
                                                        $mrkValTtl = 0;
                                                        $allMrkTotal = 0;
                                                       
                                                        @endphp
                                                    @foreach ($allproduct as $product)

                                                    @if ($product->container_id == $cus->container_id )
                                                    @if ($cat->id == $product->category_id)
                                                        @php

                                                            $makr_total = 0;
                                                            $totalQty += $product->stock;
                                                            $chkid = json_decode($product->all_mark_id);
                                                                        $chkval = json_decode($product->all_mark_data);

                                                        @endphp
                                                        @if ($chk == 0)
                                                          <table class="table table-head-bg-success">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">{{$product->category_name}}</th>
                                                                    <th scope="col">Unit</th>
                                                                    <th scope="col">T.Qty</th>
                                                                    <th scope="col">Saleing</th>
                                                                    <th scope="col">Vat 5%</th>
                                                                    <th scope="col">Total Price</th>
                                                                    @foreach ($allmark as $mrk)
                                                                    {{-- @php
                                                                    echo '<pre>'; print_r($mrk); exit;
                                                                        @endphp --}}
                                                                    <th scope="col">{{$mrk['name']}}</th>
                                                                    @endforeach
                                                                    <th scope="col">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @php
                                                                    $chk = 1;
                                                                @endphp
                                                        @endif
                                                        @php
                                                        $mrkVal2 = 0;
                                                 @endphp
                                                 @foreach ($allmark as $key1=>$vl)
                                                 @foreach ($chkid as $key=>$vl1)

                                                 @if($vl['id'] == $vl1->id)
                                                     @php
                                                         $mrkVal2 += $chkval[$key];
                                                     @endphp
                                                 @endif
                                                 @endforeach
                                                 @endforeach
                                                 @if($mrkVal2>0)
                                                                        <tr>
                                                                            <td>
                                                                                {{ $product->product_name }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $product->unit_name }}
                                                                            </td>
                                                                            <td>
                                                                               
                                                                                {{ $mrkVal2 }}
                                                                            </td>
                                                                            <td>
                                                                                {{number_format( $product->price_value ,2) }}
                                                                            </td>
                                                                            @php
                                                                                if($product->vat != 0){
                                                                                    $vat = ($product->price_value * $mrkVal2) * 0.05;
                                                                                    $mrkTotal = ($product->price_value * $mrkVal2) + $vat;
                                                                                }else {
                                                                                    $vat = '';
                                                                                    $mrkTotal = ($product->price_value * $mrkVal2);
                                                                                }
                                                                                $allMrkTotal += $mrkTotal;
                                                                                $finalMrkTotal += $mrkTotal;
                                                                            @endphp
                                                                            <td>
                                                                                {{ $vat }}
                                                                            </td>
                                                                            <td>
                                                                                {{number_format( $mrkTotal,2) }}
                                                                            </td>
                                                                            @php
                                                                                   $mrkVal = 0;
                                                                            @endphp
                                                                            @foreach ($allmark as $key1=>$vl)
                                                                            @foreach ($chkid as $key=>$vl1)

                                                                            @if($vl['id'] == $vl1->id)
                                                                                @php
                                                                                $mrkTtl [$key1][]= $chkval[$key];
                                                                                    $mrkVal += $chkval[$key];
                                                                                @endphp
                                                                            <td>{{$chkval[$key]}}</td>
                                                                            @endif
                                                                            @endforeach
                                                                            @endforeach
                                                                            <td>{{$mrkVal}}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @endif
                                                                        @endif
                                                                        @php
                                                                            $mrkValTtl += $mrkVal;
                                                                        @endphp
                                                                @endforeach
                                                                @if ($chk != 0)
                                                                <tr style="background-color: #d4fbd4;">
                                                                    <td style="text-align: right; font-size:25px; font-weight:600;"
                                                                        colspan=2>
                                                                    </td>

                                                                    <td>
                                                                        {{$totalQty}}
                                                                    </td>
                                                                    <td style="text-align: right; font-size:25px; font-weight:600;"
                                                                        colspan=2>
                                                                    </td>
                                                                    <td style="text-align: left;">
                                                                        {{ number_format($allMrkTotal,2) }} 

                                                                    </td>
                                                                    @foreach ($allmark as $key1=>$vl)
                                                                    <td style="text-align: left;">
                                                                        @php
                                                                        $allmrkTtl [$key1][]= array_sum($mrkTtl[$key1]);
                                                                            echo array_sum($mrkTtl[$key1]);
                                                                        @endphp
                                                                    </td>
                                                                    @endforeach
                                                                    @php
                                                                        $allmrkValTtl += $mrkValTtl;
                                                                    @endphp
                                                                    <td>{{$mrkValTtl}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                
                                                            </tbody>
                                                            <tfoot>
                                                               
                                                                <tr>
                                                                    <td style="text-align: right; font-size:25px; font-weight:600;" colspan=4>
                                                                    <td style="background-color: #d5b4f4;">GRAND TOTAL</td>
                                                                    <td style="background-color: #d5b4f4;">{{number_format( $finalMrkTotal,2) }}</td>
                                                                    @foreach ($allmark as $key1=>$vl)
                                                                    <td style="background-color: #d5b4f4;">
                                                                        @php
                                                                            echo array_sum($allmrkTtl[$key1]);
                                                                        @endphp
                                                                    </td>
                                                                    @endforeach
                                                                   <td style="background-color: #d5b4f4;"> {{$allmrkValTtl}}</td>
                                                                </tr>
                                                              </tfoot>
                                                        </table>
                                                        <table>
                                                            <tbody>
                                                               
                                                            </tbody>
                                                        </table>
                                </div>
                            </div>
                            @php
                                $increment++;
                                $total_expense += $container_total;
                            @endphp
                            @endforeach

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


@endsection

@extends('layouts.appseller')

@section('content')
    <div class="col-md-9">
        <h3>{{ $page }}</h3>
        <style type="text/css">
            .mt-20 {
                margin-top: 20px;
            }

        </style>
        <div class="container-fluid margin50">
            <div class="row">
                @if (auth()->user()->hasRole('seller'))
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="practiceareaPrt">
                            <a href="{{ route('product.my') }}">
                                <img src="images/icon/customer-icon1.png" alt="icon">
                                <div class="righticonTxt">
                                    <h3>{{ $totalProduct }}</h3>
                                    <p>Total Products</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="practiceareaPrt">
                        <a href="{{ route('request.index') }}">
                            <img src="images/icon/customer-icon2.png" alt="icon">
                            <div class="righticonTxt">
                                <h3>{{ $totalRequest }}</h3>
                                <p>Total Requests</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="practiceareaPrt">
                        <a href="{{ url('quote') }}">
                            <img src="images/icon/customer-icon3.png" alt="icon">
                            <div class="righticonTxt">
                                <h3>{{ $totalQuotes }}</h3>
                                <p>Total Quotes</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 mt-20">
                    <div class="practiceareaPrt">
                        <a href="{{ url('purchaseorders') }}">
                            <img src="images/icon/customer-icon4.png" alt="icon">
                            <div class="righticonTxt">
                                <h3>{{ $totalPurchases }}</h3>
                                <p>Purchase Order</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 mt-20">
                    <div class="practiceareaPrt">
                        <a href="{{ url('purchaseorders/create') }}">
                            <img src="images/icon/customer-icon4.png" alt="icon">
                            <div class="righticonTxt">
                                <h3>{{ $totalCompleted }}</h3>
                                <p>Completed Order</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 mt-20">
                    <div class="practiceareaPrt">
                        <a href="{{ url('achieved') }}">
                            <img src="images/icon/customer-icon4.png" alt="icon">
                            <div class="righticonTxt">
                                <h3>{{ $totalArchieved }}</h3>
                                <p>Achieved Quotes</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>

        {{-- <div class="container-fluid margin50">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="practiceareaPrt5">

                        <h4 class="text-center">My Products</h4>
                        <canvas id="myChart" width="400" height="400"></canvas>

                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="practiceareaPrt5">

                        <h4 class="text-center">Recent Orders</h4>
                        <canvas id="myChartOrders" width="400" height="400"></canvas>

                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid margin50">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="practiceareaPrt5">

                        <h4 class="text-center">Quotes</h4>
                        <canvas id="myChartQuotes" width="400" height="400"></canvas>

                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="practiceareaPrt5">

                        <h4 class="text-center">Call Back Requests</h4>
                        <canvas id="myChartOrders" width="400" height="400"></canvas>

                    </div>
                </div>
            </div>

        </div> --}}
    </div>
@stop

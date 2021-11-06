@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-secondary-gradient">
                <div class="page-inner pt-5 pb-5">
                    <h2 class="text-white pb-2">MamboDubai Administration</h2>
                    <h5 class="text-white op-7 mb-2">Controlled By Super Admin</h5>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row row-card-no-pd mt--2">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-chart-pie text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Sellers</p>
                                            <h4 class="card-title">{{ $seller }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Buyers</p>
                                            <h4 class="card-title">{{ $buyer }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-error text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Products</p>
                                            <h4 class="card-title">{{ $product }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-twitter text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Requests</p>
                                            <h4 class="card-title">{{ $request }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">User Statistics</div>
                                    <div class="card-tools">
                                        <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                            <span class="btn-label">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            Export
                                        </a>
                                        <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                            <span class="btn-label">
                                                <i class="fa fa-print"></i>
                                            </span>
                                            Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="statisticsChart"></canvas>
                                </div>
                                <div id="myChartLegend"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="card-title">Quotes</div>
                                <div class="card-category">March 25 - April 02</div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="mb-4 mt-2">
                                    <h1>$4,578.58</h1>
                                </div>
                                <div class="pull-in">
                                    <canvas id="dailySalesChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary bg-primary-gradient">
                            <div class="card-body">
                                <h4 class="mb-1 fw-bold">Ongoing Request</h4>
                                <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-right text-primary">+5%</div>
                                <h2 class="mb-2">17</h2>
                                <p class="text-muted">Seller online</p>
                                <div class="pull-in sparkline-fix">
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-right text-danger">-3%</div>
                                <h2 class="mb-2">27</h2>
                                <p class="text-muted">Buyers Online</p>
                                <div class="pull-in sparkline-fix">
                                    <div id="lineChart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="h1 fw-bold float-right text-warning">+7%</div>
                                <h2 class="mb-2">213</h2>
                                <p class="text-muted">Completed Orders</p>
                                <div class="pull-in sparkline-fix">
                                    <div id="lineChart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Latest Products</div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">CSS</h6>
                                        <small class="text-muted">Cascading Style Sheets</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$17</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                        <small class="text-muted">The Best Donuts</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$300</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct3.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">Ready Pro</h6>
                                        <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$350</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="pull-in">
                                    <canvas id="topProductsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title fw-mediumbold">Latest Users</div>
                                <div class="card-list">
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/jm_denis.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Jimmy Denis</div>
                                            <div class="status">Graphic Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/chadengle.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Chad</div>
                                            <div class="status">CEO Zeleaf</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Talha</div>
                                            <div class="status">Front End Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">John Doe</div>
                                            <div class="status">Back End Developer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Talha</div>
                                            <div class="status">Front End Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/img/jm_denis.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Jimmy Denis</div>
                                            <div class="status">Graphic Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-xs">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Latest Quotations</div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">CSS</h6>
                                        <small class="text-muted">Cascading Style Sheets</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$17</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                        <small class="text-muted">The Best Donuts</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$300</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/img/logoproduct3.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h6 class="fw-bold mb-1">Ready Pro</h6>
                                        <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$350</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="pull-in">
                                    <canvas id="topProductsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

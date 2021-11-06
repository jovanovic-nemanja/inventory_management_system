@extends('layouts.inventory')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Edit Customer</h4>
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
                            <a href="#">Customer</a>
                        </li>
                    </ul>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('customer.update') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <input type="hidden" name="customer_id" value="{{$customer->id}}" />
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input required="" type="text" name="name" class="form-control"
                                           value="{{$customer->name}}" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input readonly="" type="email" name="email" class="form-control"
                                        value="{{$customer->email}}"  placeholder="email" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input required="" type="text" name="phone" class="form-control"
                                        value="{{$customer->phone}}"   placeholder="phone" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Initial Balance</label>
                                        <input readonly="" type="text" name="balance" class="form-control"
                                        value="{{$customer->balance}}"   placeholder="Initial Balance" />
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

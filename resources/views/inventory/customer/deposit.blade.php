@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Deposit Amount</h4>
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
                        <a href="#">Deposit</a>
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
                                <input type="hidden" name="name" value="{{$customer->name}}" />
                                <input type="hidden" name="email" value="{{$customer->email}}" />
                                <input type="hidden" name="phone" value="{{$customer->phone}}" />
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Initial Balance</label>
                                        <input readonly="" type="text" name="balance" class="form-control"
                                            value="{{$customer->balance}}" placeholder="Initial Balance" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Current Balance</label>
                                        <input readonly="" type="text" name="current_balance" class="form-control"
                                            value="{{$customer->current_balance}}" placeholder="Current Balance" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Deposit Balance</label>
                                        <input required="" type="text" name="deposit_balance" class="form-control"
                                            placeholder="Deposit Balance" />
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label for="birthday">Deposit Date:</label>
                                        <input type="date" required="" class="form-control" name="deposit_date" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input required="" type="text" name="remarks" class="form-control"
                                            placeholder="Remarks" />
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Deposit Deatils</h4>
                            <a href="{{ url('/inventory/customer/downloadExcel/xlsx') }}" class="btn btn-warning btn-round ml-auto" type="button"><i class="fa fa-download"></i>Customer balance ledger</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Current Balance</th>
                                        <th>Deposit Balance</th>
                                        <th>Deposit Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alldeposit as $deposit)
                                    <tr>
                                        <td>{{ $deposit->created_at }}</td>
                                        <td>{{ $deposit->current_balance }}</td>
                                        <td>{{ $deposit->deposit_balance }}</td>
                                        <td>{{ $deposit->deposit_date }}</td>
                                        <td>{{ $deposit->remarks }}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

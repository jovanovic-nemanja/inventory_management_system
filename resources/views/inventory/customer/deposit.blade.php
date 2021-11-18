@extends('layouts.inventory', ['menu' => 'customer'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Deposit Amount </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventory/customer') }}">Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page">Deposit Amount</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('customer.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="customer_id" value="{{$customer->id}}" />
                    <input type="hidden" name="name" value="{{$customer->name}}" />
                    <input type="hidden" name="email" value="{{$customer->email}}" />
                    <input type="hidden" name="phone" value="{{$customer->phone}}" />

                    <div class="form-group">
                        <label>Initial Balance</label>
                        <input readonly="" type="text" name="balance" class="form-control"
                            value="{{$customer->balance}}" placeholder="Initial Balance" />
                    </div>
                    <div class="form-group">
                        <label>Current Balance</label>
                        <input readonly="" type="text" name="current_balance" class="form-control"
                            value="{{$customer->current_balance}}" placeholder="Current Balance" />
                    </div>
                    <div class="form-group">
                        <label>Deposit Balance</label>
                        <input required="" type="text" name="deposit_balance" class="form-control"
                            placeholder="Deposit Balance" />
                    </div>
                    <div class="form-group">
                        <label for="birthday">Deposit Date:</label>
                        <input type="date" required="" class="form-control" name="deposit_date" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input required="" type="text" name="remarks" class="form-control"
                            placeholder="Remarks" />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
                <br>

                <div class="row justify-content-between pt-5 pb-3">
                    <h4 class="card-title">Deposit Deatils</h4>
                    <div class="text-right">
                        <a href="{{ url('/inventory/customer/downloadExcel/xlsx') }}" class="btn btn-primary btn-round ml-auto" type="button"><i class="fa fa-download"></i>Customer balance ledger</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table product-list">
                                <thead>
                                    <tr>
                                        <th>No#</th>
                                        <th>Date</th>
                                        <th>Current Balance</th>
                                        <th>Deposit Balance</th>
                                        <th>Deposit Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($alldeposit as $deposit)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $deposit->created_at }}</td>
                                            <td>{{ $deposit->current_balance }}</td>
                                            <td>{{ $deposit->deposit_balance }}</td>
                                            <td>{{ $deposit->deposit_date }}</td>
                                            <td>{{ $deposit->remarks }}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
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

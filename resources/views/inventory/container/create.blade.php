@extends('layouts.inventory', ['menu' => 'container'])

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
</style>

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Create Container </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/container') }}">Container</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Container</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('container.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group" style="display: none;">
                                <label>Container ID</label>
                                <input required="" type="text" name="container_id" class="form-control"
                                   value="{{rand(00000, 99999)}}" readonly placeholder="Container ID" />
                            </div>
                            <div class="form-group">
                                <label>Shipping Date</label>
                                <input type="date" required name="shipping_date" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Container Batch:</label>
                                <select name="container_batch" id="container_batch" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allbatch as $detail)
                                        <option value="{{ $detail->id }}">
                                            {{ $detail->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Shipper information</label>
                                <select name="shipper_info" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allshipper as $detail)
                                            <option value="{{ $detail->id }}">
                                                {{ $detail->name }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Notify information</label>
                                <select name="notify_info" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allcontainerdetail as $detail)
                                            <option value="{{ $detail->id }}">
                                                {{ $detail->notify_info }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Port of Loading</label>
                                <select name="port_loading" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allcontainerdetail as $detail)
                                            <option value="{{ $detail->id }}">
                                                {{ $detail->port_loading }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Container Type</label>
                                <select name="container_type" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Owner Name:</label>
                                <input type="text" name="owner_name" id="owner_name" class="form-control" placeholder="Owner Name" required />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Seal Number:</label>
                                <input type="text" name="seal_number" id="seal_number" class="form-control" placeholder="Seal Number" required />
                            </div>
                            <div class="form-group">
                                <label>Container Number:</label>
                                <input type="text" name="container_number" id="container_number" class="form-control" placeholder="Container Number" required />
                            </div>
                            <div class="form-group">
                                <label>Bill of Loading:</label>
                                <input type="text" name="bill_loading" class="form-control" placeholder="Bill of Loading" required />
                            </div>
                            <div class="form-group">
                                <label>Consignee information</label>
                                <select name="consignee_info" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allconsignee as $detail)
                                            <option value="{{ $detail->id }}">
                                                {{ $detail->name }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Vessel and Voage Number</label>
                                <input type="text" name="vessel_no" class="form-control" placeholder="Vessel and Voage Number" required />
                            </div>
                            <div class="form-group">
                                <label>Port of Discharge</label>
                                <select name="port_discharge" class="form-control myselect2" required>
                                    <option value="">Please Choose</option>
                                    @foreach ($allcontainerdetail as $detail)
                                        <option value="{{ $detail->id }}">
                                            {{ $detail->port_discharge }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="card" id="card-header">
                            <div>
                                <a type="button" id="add_customer" href="#" class="btn btn-success btn-secondary btn-round">
                                    <i class="fa fa-plus"></i>
                                    Add Customer
                                </a>
                            </div>
                        </div>
                        <div class="divCustomer pt-3">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="" id="v-pills-tabContent">
                                        <div class="tab-pane fade active show" id="v-pills-home-icons"
                                            role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                            <div class="accordion accordion-secondary">
                                                <div class="card ">
                                                    <div class="">
                                                        <div class="span-title"  style="margin-right:30px;">
                                                            <select name="customer_id[]" id="customerList_1" required
                                                                class="form-control myselect2">
                                                                <option value="">Select Customer</option>
                                                                @foreach ($allcustomers as $key => $customer)

                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->name }}
                                                                    </option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="pt-5">
                                                        <div class="">
                                                            <button type="button" id="addMark_1" class="btn btn-primary btn-round addMark">Add Marks + </button>
                                                            <div class="bg-white markDiv_1">
                                                                <div class="span-title pt-3">
                                                                    <input type="text" name="mark_1[]" class="form-control" placeholder="Mark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-5">
                                <div class="">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="reset" class="btn btn-warning">Cancel</button>
                                    <button class="btn btn-danger pull-right">Lock Container</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="divCustomer pt-3" id="customer_div" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="" id="v-pills-tabContent">
                <div class="tab-pane fade active show" id="v-pills-home-icons" role="tabpanel"
                    aria-labelledby="v-pills-home-tab-icons">
                    <div class="accordion accordion-secondary">
                        <div class="card">
                            <div>
                                <div class="span-title" style="margin-right:30px;">
                                    <select name="customer_id[]" id="customerList" required class="form-control select2">
                                        <option value="">Select Customer</option>
                                        @foreach ($allcustomers as $key => $customer)

                                            <option value="{{ $customer->id }}">
                                                {{ $customer->name }}
                                            </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="ml-auto pt-3"><button type="button" class="btn btn-danger"
                                        onclick="deleteCustomer(this)">Remove Customer</button></div>
                            </div>
                            <div class="pt-5">
                                <div class="">
                                    <button type="button" class="btn btn-primary btn-round" id="addMarkBtnId"> Add Marks + </button>
                                    <div class="bg-white" id="addMark">
                                        <div class="span-title pt-3 pb-3">
                                            <input type="text" name="mark[]" id="nameMark" class="form-control" placeholder="Mark" />
                                        </div>
                                        <button type="button" class="btn btn-danger" onclick="deleteThis(this)">
                                            Delete Mark
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

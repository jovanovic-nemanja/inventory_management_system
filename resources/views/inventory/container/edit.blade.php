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
        <h3 class="page-title"> Edit Container </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container') }}">Container List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Container</li>
            </ol>
        </nav>
    </div>

    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('container.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">

                                <input type="hidden" name="con_id" value="{{ $container_detail->id }}" />

                                <div class="form-group" style="display: none;">
                                    <label>Container ID</label>
                                    <input required="" readonly type="text" name="container_id"
                                        value="{{ $container_detail->containerid }}" class="form-control"
                                        placeholder="Container ID" />
                                </div>
                                <div class="form-group">
                                    <label>Shipping Date</label>
                                    <input type="date" required name="shipping_date" class="form-control" value="{{ $container_detail->shipping_date }}" />
                                </div>
                                <div class="form-group">
                                    <label>Container Batch:</label>
                                    <select name="container_batch" id="container_batch"
                                        class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allbatch as $detail)
                                            @if ($detail->id == $container_detail->container_batch)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Shipper information</label>
                                    <select name="shipper_info" class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allshipper as $detail)
                                            @if ($detail->id == $container_detail->shipper_info)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Notify information</label>
                                    <select name="notify_info" class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allcontainerdetail as $detail)
                                            @if ($detail->id == $container_detail->notify_info)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->notify_info }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->notify_info }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Port of Loading</label>
                                    <select name="port_loading" class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allcontainerdetail as $detail)
                                            @if ($detail->id == $container_detail->port_loading)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->port_loading }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->port_loading }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Container Type</label>
                                    <select name="container_type" class="form-control myselect2" required>
                                        <option value="">Please Select</option>
                                        @foreach ($types as $type)
                                            @if ($type->id == $container_detail->container_type)
                                                <option selected value="{{ $type->id }}">
                                                    {{ $type->title }}
                                                </option>
                                            @else
                                                <option value="{{ $type->id }}">
                                                    {{ $type->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Owner Name:</label>
                                    <input type="text" name="owner_name" id="owner_name" class="form-control" placeholder="Owner Name" value="{{ $container_detail->owner_name }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Seal Number:</label>
                                    <input type="text" name="seal_number" id="seal_number" class="form-control" placeholder="Seal Number" value="{{ $container_detail->seal_number }}" />
                                </div>
                                <div class="form-group">
                                    <label>Container Number:</label>
                                    <input type="text" name="container_number" id="container_number"
                                        value="{{ $container_detail->container_number }}"
                                        class="form-control" placeholder="Container Number">
                                </div>
                                <div class="form-group">
                                    <label>Bill of Loading:</label>
                                    <input type="text" name="bill_loading"
                                        value="{{ $container_detail->bill_loading }}" class="form-control"
                                        placeholder="Bill of Loading">
                                </div>
                                <div class="form-group">
                                    <label>Consignee information</label>
                                    <select name="consignee_info" class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allconsignee as $detail)
                                            @if ($detail->id == $container_detail->consignee_info)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Vessel and Voage Number</label>
                                    <input type="text" name="vessel_no"
                                        value="{{ $container_detail->vessel_no }}" class="form-control"
                                        placeholder="Vessel and Voage Number">
                                </div>
                                <div class="form-group">
                                    <label>Port of Discharge</label>
                                    <select name="port_discharge" class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allcontainerdetail as $detail)
                                            @if ($detail->id == $container_detail->port_discharge)
                                                <option selected value="{{ $detail->id }}">
                                                    {{ $detail->port_discharge }}
                                                </option>
                                            @else
                                                <option value="{{ $detail->id }}">
                                                    {{ $detail->port_discharge }}
                                                </option>
                                            @endif
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
                            @php
                                $inc = sizeof($cus_no);
                            @endphp
                            @foreach ($cus_no as $no)
                                <div class="divCustomer pt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="">
                                                <div class="tab-pane fade active show">
                                                    <div class="accordion accordion-secondary">
                                                        <div class="card ">
                                                            <div class="">
                                                                <div class="span-title" style="margin-right:30px;">
                                                                    <select name="customer_id[]"
                                                                        id="customerList_{{ $inc }}" required
                                                                        class="form-control myselect2">
                                                                        <option value="">Select Customer</option>
                                                                        @foreach ($allcustomers as $customer)
                                                                            @if ($customer->id == $no->customer_id)
                                                                                <option selected=""
                                                                                    value="{{ $customer->id }}">
                                                                                    {{ $customer->name }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $customer->id }}">
                                                                                    {{ $customer->name }}
                                                                                </option>
                                                                            @endif

                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="pt-5">
                                                                <div class="">
                                                                    <button type="button"
                                                                        id="addMark_{{ $inc }}"
                                                                        class="btn btn-primary btn-round addMark">
                                                                        Add Marks +
                                                                    </button>
                                                                    @foreach ($con_cus as $markdetail)
                                                                        @if ($no->customer_id == $markdetail->customer_id)
                                                                            <div class="bg-white markDiv_{{ $inc }}">
                                                                                <div class="span-title pt-3">
                                                                                    <input type="hidden"
                                                                                        name="markid_{{ $inc }}[]"
                                                                                        value="{{ $markdetail->id }}" />
                                                                                    <input type="text"
                                                                                        name="mark_{{ $inc }}[]"
                                                                                        value="{{ $markdetail->name }}"
                                                                                        class="form-control"
                                                                                        placeholder="Mark" />
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $inc--;
                                @endphp
                            @endforeach
                            <div class="pt-5">
                                <div class="">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="reset" class="btn btn-warning">Cancel</button>
                                    <a id="alert_demo_7" class="btn btn-danger pull-right">Lock Container</a>
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
                                        <select name="customer_id[]" id="customerList" required class="form-control slect">
                                            <option value="">Select Customer</option>
                                            @foreach ($allcustomers as $key => $customer)

                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->name }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="ml-auto">
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteCustomer(this)">Remove Customer</button>
                                    </div>

                                </div>
                                <div class="pt-5">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-round" id="addMarkBtnId">
                                            Add Marks +
                                        </button>
                                        <div class="bg-white" id="addMark">
                                            <div class="span-title pt-3 pb-3">
                                                <input type="text" name="mark[]" id="nameMark" class="form-control"
                                                    placeholder="Mark" />
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

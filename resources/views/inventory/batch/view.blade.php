@extends('layouts.inventory', ['menu' => 'batch'])

@section('content')

    <?php echo displayAlert(); ?>
    @if ($errors->any())
    @endif

    <div class="page-header">
        <h3 class="page-title"> {{$batch_detail->name}} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container/batch') }}">Batch</a></li>
                <li class="breadcrumb-item active" aria-current="page">View</li>
            </ol>
        </nav>
    </div>

    <div class="card grid-margin">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No #</th>
                                    <th>Date</th>
                                    <th>Container Number</th>
                                    <th>Shipper Name</th>
                                    <th>Consignee Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($allcontainer as $category)
                                    <tr style="background-color: #cef0ac;">
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->container_number }}</td>
                                        <td>{{ $category->shipper_name }}</td>
                                        <td>{{ $category->consignee_name }}</td>
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
@stop

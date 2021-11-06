@extends('layouts.inventory')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            @if ($errors->any())
            @endif
            <div class="page-header">
                <h4 class="page-title">Batch</h4>
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
                        <a href="#">Batch</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                           <h2 class="page-title" style="color:#6761b5;"> {{$batch_detail->name}} </h2>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Container Number</th>
                                            <th>Shipper Name</th>
                                            <th>Consignee Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allcontainer as $category)
                                        <tr style="background-color: #cef0ac;">
                                            <td>{{ $category->created_at }}</td>
                                            <td>{{ $category->container_number }}</td>
                                            <td>{{ $category->shipper_name }}</td>
                                            <td>{{ $category->consignee_name }}</td>

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
</div>
@stop

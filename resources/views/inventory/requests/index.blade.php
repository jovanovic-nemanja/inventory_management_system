@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Requests</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="/">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Requests </a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="requests-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">ID</th>
                                                {{-- <th>Sender</th> --}}
                                                <th>Date</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $request)
                                                <tr>
                                                    <td>{{ $request->id }}</td>
                                                    {{-- @if (!empty($request->sender))
                                                            <td>{{ $request->getUsername($request->sender) }}</td>
                                                    @else
                                                            <td></td>
                                                        @endif --}}

                                                    <td>{{ $request->sign_date }}</td>
                                                    <td>{{ $request->product_name }}</td>
                                                    <td>{{ $request->req_quantity }} {{ $request->unitname }}</td>



                                                    <td>{{ $request->getstatuesname($request->status) }}</td>
                                                    <td>
                                                        {{-- @if ($request->status == 1 || $request->status == null)
                                                            <a href="{{ route('requests.show', $request->id) }}"
                                                                class="btn btn-primary btn-sm btn-flat" title="Approve">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                            <a href="{{ route('requests.assign', $request->id) }}"
                                                                class="btn btn-primary btn-sm btn-flat" title="Assigning">
                                                                <i class="fa fa-tags"></i>
                                                            </a>
                                                        @endif
                                                        @if ($request->status == 2)
                                                            <a href="{{ route('requests.show', $request->id) }}"
                                                                class="btn btn-primary btn-sm btn-flat" title="Pending">
                                                                <i class="fa fa-ban"></i>
                                                            </a>
                                                        @endif --}}

                                                        <a href="{{ route('requests.view', $request->id) }}"
                                                            class="btn btn-success btn-sm btn-flat" title="Detail">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('requests.edit', $request->id) }}"
                                                            class="btn btn-danger btn-sm btn-flat" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
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

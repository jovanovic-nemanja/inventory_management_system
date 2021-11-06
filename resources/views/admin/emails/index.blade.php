@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Emails</h4>
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
                            <a href="#">Email</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Summary</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($emails as $email)
                                                <tr>
                                                    <td>{{ $email->id }}</td>
                                                    <td>{{ $email->sender_address }}</td>
                                                    <td>{{ $email->receiver_address }}</td>
                                                    <td>{{ $email->header }}</td>
                                                    <td>{{ $email->title }}</td>
                                                    <td>{{ $email->description }}</td>
                                                    <td>{{ $email->sign_date }}</td>
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

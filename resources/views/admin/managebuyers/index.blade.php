@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Block Status</th>
                                                <th>Verified Status</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $buyer)
                                                @if ($buyer->hasRole('buyer'))
                                                    <tr>
                                                        <td>{{ $buyer->id }}</td>
                                                        <td>{{ $buyer->name }}</td>
                                                        <td>{{ $buyer->email }}</td>
                                                        <td>{{ $buyer->getBlockstatus($buyer->block) }}</td>
                                                        <td>{{ $buyer->getVerifiedstatus($buyer->verified) }}</td>

                                                        <td>
                                                            <div class="form-button-action">
                                                                @if ($buyer->block == 0)
                                                                    <a title="Block"
                                                                        href="{{ route('managebuyers.edit', $buyer->id) }}"
                                                                        class="btn btn-danger btn-sm btn-flat">
                                                                        <i class="fa fa-lock"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($buyer->block == 1)
                                                                    <a title="Approve"
                                                                        href="{{ route('managebuyers.show', $buyer->id) }}"
                                                                        class="btn btn-success btn-sm btn-flat">
                                                                        <i class="fa fa-unlock"></i>
                                                                    </a>
                                                                @endif

                                                                @if ($buyer->verified == 1)
                                                                    <a title="Verify"
                                                                        href="{{ route('managebuyers.verify', $buyer->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($buyer->verified == 2)
                                                                    <a title="Not Verify"
                                                                        href="{{ route('managebuyers.notverify', $buyer->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                @endif

                                                                <a title="Detail"
                                                                    href="{{ url('/userprofile/view', $buyer->id) }}"
                                                                    class="btn btn-success btn-sm btn-flat">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
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

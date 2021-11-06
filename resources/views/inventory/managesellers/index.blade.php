@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
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
                                            @foreach ($categories as $seller)
                                                @if ($seller->hasRole('seller'))
                                                    <tr>
                                                        <td>{{ $seller->id }}</td>
                                                        <td>{{ $seller->name }}</td>
                                                        <td>{{ $seller->email }}</td>
                                                        <td>{{ $seller->getBlockstatus($seller->block) }}</td>
                                                        <td>{{ $seller->getVerifiedstatus($seller->verified) }}</td>

                                                        <td>
                                                            <div class="form-button-action">
                                                                @if ($seller->block == 0)
                                                                    <a title="Block"
                                                                        href="{{ route('managesellers.edit', $seller->id) }}"
                                                                        class="btn btn-danger btn-sm btn-flat">
                                                                        <i class="fa fa-lock"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($seller->block == 1)
                                                                    <a title="Approve"
                                                                        href="{{ route('managesellers.show', $seller->id) }}"
                                                                        class="btn btn-success btn-sm btn-flat">
                                                                        <i class="fa fa-unlock"></i>
                                                                    </a>
                                                                @endif

                                                                @if ($seller->verified == 1)
                                                                    <a title="Verify"
                                                                        href="{{ route('managesellers.verify', $seller->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($seller->verified == 2)
                                                                    <a title="Not Verify"
                                                                        href="{{ route('managesellers.notverify', $seller->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                @endif

                                                                <a title="Detail"
                                                                    href="{{ route('managesellers.details', $seller->id) }}"
                                                                    class="btn btn-success btn-sm btn-flat">
                                                                    <i class="fa fa-eye"></i>
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

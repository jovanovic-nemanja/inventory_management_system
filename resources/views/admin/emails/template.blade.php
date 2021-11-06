@extends('layouts.admin')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Email Template List</h4>
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
                        <a href="#"> Template List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"> Template List</h4>
                                <a type="button" href="{{ url('/admin/template/create') }}" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Create Template

                                </a>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Name</th>
                                                <th>subject</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>action</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alltemplate as $template)
                                            <tr>
                                                <td>{{ $template->id }}</td>
                                                <td>{{ $template->email_name }}</td>
                                                <td>{{ $template->email_subject }}</td>
                                                <td>
                                                @if(!empty($template->email_type))
                                                    active
                                                    @else
                                                    Inactive
                                                    @endif
                                                </td>
                                                <td>{{ $template->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('template.edit', $template->id) }}" class="btn btn-success btn-sm btn-flat" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a target="_blank" href="{{ route('template.view', $template->id) }}" class="btn btn-success btn-sm btn-flat" title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    @if(empty($template->email_type))
                                                    <a href="{{ route('template.delete', $template->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    @endif
                                                 
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
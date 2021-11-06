@extends('layouts.admin')

@section('content')

    @if (session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Blog</h4>
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
                            <a href="#">Blog</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <input type="hidden" class="url" value="{{ Route('products.approveproductsbychoosing') }}" />
                    <input type="hidden" class="checkVals" />
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">List Of Blog</div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="table-responsive">
                                            <table id="add-row" class="table table-bordered table-striped">

                                                <thead>
                                                    <tr>
                                                        {{-- <th><input type='checkbox' id="selectAll" /></th> --}}
                                                        <th width="50px">No</th>
                                                        <th>Title</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th width="150px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($blogs as $blog)

                                                        <tr>
                                                            {{-- <td><input type='checkbox' class='checks' name='checks[]'
                                                                    value='{{ $blog->id }}' />
                                                            </td> --}}
                                                            <td>{{ $blog->id }}</td>
                                                            <td>{{ str_limit($blog->title, 30, '...') }}</td>


                                                            @if ($blog->status == 0 || $blog->status == null)
                                                                <td>Pending</td>
                                                            @endif
                                                            @if ($blog->status == 1)
                                                                <td>Approved</td>
                                                            @endif

                                                            <td>{{ $blog->created_at }}</td>
                                                            <td>
                                                                @if ($blog->status == 0 || $blog->status == null)
                                                                    <a href="{{ route('blog.approve', $blog->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat"
                                                                        title="Approve">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($blog->status == 1)
                                                                    <a href="{{ route('blog.deapprove', $blog->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat"
                                                                        title="Pending">
                                                                        <i class="fa fa-ban"></i>
                                                                    </a>
                                                                @endif

                                                                <a href="{{ url('/blogdetail/' . $blog->id) }}"
                                                                    class="btn btn-success btn-sm btn-flat" target="_blank"
                                                                    title="Detail">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                <a href="{{ route('adminblog.destroy', $blog->id) }}"
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
        </div>

    </div>
@stop

@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
				<div class="page-header">
						<h4 class="page-title">Request Call Back</h4>
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
								<a href="#">Request Call Back</a>
							</li>
						</ul>
					</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">List of Call Back Requests</h4>
                                    <!--<button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                        data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Create Category
                                    </button>-->
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        New</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Create a new row using this form, make sure you fill them
                                                    all</p>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" type="text" class="form-control"
                                                                    placeholder="fill name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Position</label>
                                                                <input id="addPosition" type="text" class="form-control"
                                                                    placeholder="fill position">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Office</label>
                                                                <input id="addOffice" type="text" class="form-control"
                                                                    placeholder="fill office">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%;">ID</th>
                                                <th width="10%;">Name</th>
                                                <th width="10%;">Email</th>
                                                <th width="10%;">Phone</th>
                                                <th width="20%;">Product Name</th>
                                                <th width="10%;">Seller Name</th>
                                                <th width="20%;">Company Name</th>
                                                <th width="10%;">Date</th>
                                                <th width="5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $request)
                                                <tr>
                                                    <td>{{ $request->id }}</td>
                                                    <td>{{ $request->name }}</td>
                                                    <td>{{ $request->email_add }}</td>
                                                    <td>{{ $request->mobile }}</td>
                                                    <td>{{ $request->prod_name }}</td>
                                                    <td>
                                                        <a style="text-decoration: underline; color: #476b91;"
                                                            href="{{ route('userprofile.view', App\Product::getsellerIdByProdcut($request->product_id)) }}">{{ App\Product::getsellerNameByProdcut($request->product_id) }}</a>
                                                    </td>
                                                    <td>{{ App\Product::getcompanyNameByProdcut($request->product_id) }}
                                                    </td>
                                                    <td>{{ $request->sign_date }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="" onclick="event.preventDefault();
           document.getElementById('delete-form-{{ $request->id }}').submit();" class="btn btn-danger btn-sm btn-flat">
                                                                <i class="fa fa-trash"></i>
                                                            </a>

                                                            <form id="delete-form-{{ $request->id }}"
                                                                action="{{ route('requestadmincallback.destroy', $request->id) }}"
                                                                method="POST" style="display: none;">
                                                                <input type="hidden" name="_method" value="delete">
                                                                @csrf
                                                            </form>
                                                        </div>
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

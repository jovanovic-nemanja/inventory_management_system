@extends('layouts.dashboards')

@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif
	<div class="card">
      	<div class="card-body" style="padding: 5%;">
            <div class="row">
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table table-bordered table-striped">
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
								@foreach($categories as $request)
								<tr>
									<td>{{ $request->id }}</td>
									<td>{{ $request->name }}</td>
									<td>{{ $request->email_add }}</td>
									<td>{{ $request->mobile }}</td>
									<td>{{ $request->prod_name }}</td>
									<td>
										<a style="text-decoration: underline; color: #476b91;" href="{{ route('userprofile.view', App\Product::getsellerIdByProdcut($request->product_id)) }}">{{ App\Product::getsellerNameByProdcut($request->product_id) }}</a>
									</td>
									<td>{{ App\Product::getcompanyNameByProdcut($request->product_id) }}</td>
									<td>{{ $request->sign_date }}</td>
									<td>
										<a href="" onclick="event.preventDefault();
			                                 document.getElementById('delete-form-{{$request->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
											<i class="fa fa-trash"></i>
										</a>

										<form id="delete-form-{{$request->id}}" action="{{ route('requestadmincallback.destroy', $request->id) }}" method="POST" style="display: none;">
							                  <input type="hidden" name="_method" value="delete">
							                  @csrf
							            </form>
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
@stop
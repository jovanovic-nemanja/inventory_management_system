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
									<th width="50px">No</th>
									<th>Name</th>
									<th>Category</th>
									<th>User</th>
									<th>Image</th>
									<th>Status</th>
									<th>Date</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $product)
								<tr>
									<td>{{ $product->id }}</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->getCategoryname($product->category_id) }}</td>
									<td>{{ $product->getUsername($product->user_id) }}</td>
									<td>
										<img class="img-fluid" width="100" src="{{ asset('uploads/') }}/{{ $product->images->first()->url }}" alt="">
									</td>

									@if($product->status == 1 || $product->status == NULL)
										<td>Pending</td>
									@endif
									@if($product->status == 2)
										<td>Approved</td>
									@endif
									@if($product->status == 3)
										<td>Deleted</td>
									@endif
									
									<td>{{ $product->sign_date }}</td>
									<td>
										@if($product->status == 1 || $product->status == NULL)
											<a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm btn-flat" title="Approve">
												<i class="fa fa-check"></i>
											</a>
										@endif
										@if($product->status == 2)
											<a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm btn-flat" title="Pending">
												<i class="fa fa-ban"></i>
											</a>
										@endif

										<a href="{{ route('product.show', $product->slug) }}" class="btn btn-success btn-sm btn-flat" title="Detail">
											<i class="fa fa-edit"></i>
										</a>
											
										<a href="{{ route('products.edit', $product->id) }}" class="btn btn-danger btn-sm btn-flat" title="Delete">
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
@stop
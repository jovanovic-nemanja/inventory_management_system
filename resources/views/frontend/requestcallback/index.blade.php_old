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
									<th width="50px">ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Product Name</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach($requestcallback as $request)
								<tr>
									<td>{{ $request->id }}</td>
									<td>{{ $request->name }}</td>
									<td>{{ $request->email_add }}</td>
									<td>{{ $request->mobile }}</td>
									<td>{{ $request->prod_name }}</td>
									<td>{{ $request->sign_date }}</td>
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
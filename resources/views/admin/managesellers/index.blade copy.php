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
									<th>Email</th>
									<th>Block Status</th>
									<th>Verified Status</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $seller)
									@if($seller->hasRole('seller'))
										<tr>
											<td>{{ $seller->id }}</td>
											<td>{{ $seller->name }}</td>
											<td>{{ $seller->email }}</td>
											<td>{{ $seller->getBlockstatus($seller->block) }}</td>
											<td>{{ $seller->getVerifiedstatus($seller->verified) }}</td>
											<td>
												@if($seller->block == 0)
													<a title="Block" href="{{ route('managesellers.edit', $seller->id) }}" class="btn btn-danger btn-sm btn-flat">
														<i class="fa fa-lock"></i>
													</a>
												@endif
												@if($seller->block == 1)
													<a title="Approve" href="{{ route('managesellers.show', $seller->id) }}" class="btn btn-success btn-sm btn-flat">
														<i class="fa fa-unlock"></i>
													</a>
												@endif

												@if($seller->verified == 1)
													<a title="Verify" href="{{ route('managesellers.verify', $seller->id) }}" class="btn btn-primary btn-sm btn-flat">
														<i class="fa fa-check"></i>
													</a>
												@endif
												@if($seller->verified == 2)
													<a title="Not Verify" href="{{ route('managesellers.notverify', $seller->id) }}" class="btn btn-primary btn-sm btn-flat">
														<i class="fa fa-times"></i>
													</a>
												@endif

												<a title="Detail" href="{{ url('/userprofile/view', $seller->id) }}" class="btn btn-success btn-sm btn-flat">
													<i class="fa fa-edit"></i>
												</a>
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
@stop

@section('js')
<script>
  $(document).ready( function () {
    $('#laravel_datatable').DataTable();
  });
</script>
@stop
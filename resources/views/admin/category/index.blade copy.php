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
      			<a href="{{ route('category.create') }}" class="ps-btn">Create Category</a>	
      		</div>
            <br>
            <div class="row">
              	<div class="col-12">
					<div class="table-responsive">
						<table id="order-listing" class="table">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Name</th>
									<th>Slug</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->name }}</td>
									<td>{{ $category->slug }}</td>
									<td>
										<a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm btn-flat">
											<i class="fa fa-edit"></i>
										</a>
										<a href="" onclick="event.preventDefault();
			                                 document.getElementById('delete-form-{{$category->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
											<i class="fa fa-trash"></i>
										</a>

										<form id="delete-form-{{$category->id}}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
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
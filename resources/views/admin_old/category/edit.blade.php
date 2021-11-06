@extends('layouts.dashboards')

@section('content')

<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
          		<form action="{{ route('category.update', $category->id) }}" method="POST">
					@csrf

					<input type="hidden" name="_method" value="put">

					<div class="box">
						<div class="box-body">
							<div class="form-group">
								<label>Name</label>
								<input required type="text" name="name" class="form-control" placeholder="Name" value="{{ $category->name }}" />
							</div>

							<div class="form-group">
								<label>Meta Title</label>
								<input required type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ $category->meta_title }}" />
							</div>

							<div class="form-group">
								<label>Meta Description</label>
								<input required type="text" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ $category->meta_description }}" />
							</div>

							<div class="form-group">
								<label>Meta Keywords</label>
								<input required="" type="text" name="meta_keywords" class="form-control" placeholder="Meta Keywords" value="{{ $category->meta_keywords }}" />
							</div>

							<div class="form-group">
								<label>Slug</label>
								<input required type="text" name="slug" class="form-control" placeholder="Slug" value="{{ $category->slug }}" />
							</div>
						</div>

						<div class="box-footer">
							<button class="ps-btn btn-flat pull-right">Update Category</button>
						</div>
					</div>
				</form>
          	</div>
      	</div>
  	</div>
</div>
@stop
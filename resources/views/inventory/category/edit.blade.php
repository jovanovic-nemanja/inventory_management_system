@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Update Category</h4>
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
                            <a href="{{ url('admin/category') }}">Category List</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input required type="text" name="name" class="form-control" placeholder="Name"
                                            value="{{ $category->name }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select name="parent" class="form-control myselect2">
                                            <option value="">Please Select</option>
                                            @foreach ($product_categories as $key => $category1)
                                                @if ($key == $category->parent)
                                                    <option selected="" value="{{ $key }}">
                                                        {{ html_entity_decode($category1) }}</option>
                                                @else
                                                    <option value="{{ $key }}">
                                                        {{ html_entity_decode($category1) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input required type="text" name="meta_title" class="form-control"
                                            placeholder="Meta Title" value="{{ $category->meta_title }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input required type="text" name="meta_description" class="form-control"
                                            placeholder="Meta Description" value="{{ $category->meta_description }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input required="" type="text" name="meta_keywords" class="form-control"
                                            placeholder="Meta Keywords" value="{{ $category->meta_keywords }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input required type="text" name="slug" class="form-control" placeholder="Slug"
                                            value="{{ $category->slug }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" required="" class="form-control">

                                            @if ($category->status == 1)
                                                <option value="">Please Select</option>
                                                <option selected="" value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            @else
                                                <option value="">Please Select</option>
                                                <option value="1">Active</option>
                                                <option selected="" value="0">Inactive</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>

                                <div class="card-action">
                                    <button class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

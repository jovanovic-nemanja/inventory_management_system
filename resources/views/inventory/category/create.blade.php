@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Create Category</h4>
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
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input required="" type="text" name="name" class="form-control"
                                            placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select name="parent" class="form-control myselect2">
                                            <option value="">Please Select</option>
                                            @foreach ($product_categories as $key => $category1)

                                                <option value="{{ $key }}">
                                                    {{ html_entity_decode($category1) }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input required type="text" name="meta_title" class="form-control"
                                            placeholder="Meta Title" />
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <input required type="text" name="meta_description" class="form-control"
                                            placeholder="Meta Description" />
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input required="" type="text" name="meta_keywords" class="form-control"
                                            placeholder="Meta Keywords" />
                                    </div>

                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input required="" type="text" name="slug" class="form-control"
                                            placeholder="Slug" />
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" required="" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-action">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

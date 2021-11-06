@extends('layouts.blogheader')


@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                            </i>
                        </div>
                        <div>Category List
                            {{-- <div class="page-title-subheading">Tables are the backbone of almost all web
							applications.
						</div> --}}
                        </div>
                    </div>
                    <div class="page-title-actions">

                        <div class="d-inline-block dropdown">

                            <a href="{{ route('blog.create') }}" type="button" aria-haspopup="true"
                                class="btn-shadow btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-business-time fa-w-20"></i>
                                </span>
                                Add Category
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">

                            <table class="mb-0 table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->title}}</td>
                                            <td>{{$category->slug}}</td>
                                            <td>
                                            @if ($category->status == 1)
                                            <div class="mb-2 mr-2 badge badge-success">Active</div>
                                            @else
                                            <div class="mb-2 mr-2 badge badge-warning">Pending</div>
                                            @endif
                                            </td>
											<td>
												<a href="{{ route('blog.edit', $category->id)}}" class="mb-2 mr-2 btn btn-secondary"><i class="fa fa-edit"></i></a>
												<button data-toggle="modal" data-target="#category-delete-modal" id="{{$category->id}}" class="mb-2 mr-2 btn btn-danger delid">
											<i class="fa fa-trash"></i>
												</button>
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
@stop

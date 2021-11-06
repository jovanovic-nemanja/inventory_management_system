@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Edit Email Template</h4>
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
                            <a href="{{ url('admin/template') }}">Email Template List</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('template.update') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $template->id}}" name="template_id"  />
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"></div>
                                    <div class="form-group">
                                        <label>Template Name</label>
                                        <span class="form-control">{{ $template->email_name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Subject</label>
                                        <input required type="text" value="{{ $template->email_subject}}" name="email_subject" class="form-control"
                                            placeholder="Meta Title" />
                                    </div>

                                    <div class="form-group">
                                        <label>Body Description</label>
                                            <textarea name="email_body" required="" rows="4" cols="50"
                                                    class="form-control ckeditor" placeholder="Write Meta Description...">{{ $template->email_body}}</textarea>
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

@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Site Settings</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="/">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Site Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Website Settings</div>

                            </div>
                            <form class="form-horizontal" method='post'
                                action="{{ route('admin.generalsetting.update', $general_setting->id) }}">
                                @csrf

                                <input type="hidden" name="_method" value="put">
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Site Name
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Site Name"
                                                aria-label="site_name" aria-describedby="username-addon"
                                                value="{{ $general_setting->site_name }}" id="site_name" name="site_name"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Site Title
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Site Title"
                                                aria-label="site_title" aria-describedby="username-addon"
                                                value="{{ $general_setting->site_title }}" id="site_title"
                                                name="site_title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Meta Title
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Meta Title"
                                                aria-label="meta_title" aria-describedby="username-addon"
                                                value="{{ $general_setting->meta_title }}" id="meta_title"
                                                name="meta_title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Meta Keywords
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Meta Keywords"
                                                aria-label="meta_keywords" aria-describedby="username-addon"
                                                value="{{ $general_setting->meta_keywords }}" id="meta_keywords"
                                                name="meta_keywords" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Meta Description</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <textarea class="form-control" id="meta_description" name="meta_description"
                                                rows="5" placeholder="Meta Description">
                                                  {{ $general_setting->meta_description }}
                                                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Site Subtitle
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Site Subtitle"
                                                aria-label="site_subtitle" aria-describedby="username-addon"
                                                value="{{ $general_setting->site_subtitle }}" id="site_subtitle"
                                                name="site_subtitle" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Site Description</label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <textarea class="form-control" id="site_desc" name="site_desc" rows="5"
                                                placeholder="Site Description">
                                                             {{ $general_setting->site_desc }}
                                                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-show-validation row">
                                    <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                        Site Footer
                                    </label>
                                    <div class="col-lg-4 col-md-9 col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Site Footer"
                                                aria-label="site_footer" aria-describedby="username-addon"
                                                value="{{ $general_setting->site_footer }}" id="site_footer"
                                                name="site_footer" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success">
                                                Update Setting
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

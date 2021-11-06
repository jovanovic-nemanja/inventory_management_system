@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content" <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Currency Settings</h4>
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
                        <a href="#">Currency</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"></div>

                        </div>
                        <form method='post'
                            action="{{ route('admin.localizationsetting.update', $localization_setting->id) }}"
                            class="form-horizontal">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                    Language
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Language" aria-label="username"
                                            aria-describedby="username-addon"
                                            value="{{ $localization_setting->language }}" id="username" name="language"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                    Currency
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Currency" aria-label="username"
                                            aria-describedby="username-addon"
                                            value="{{ $localization_setting->currency }}" id="currency" name="currency"
                                            required>
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

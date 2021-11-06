@extends('layouts.blogheader')

@section('content')

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-display1 icon-gradient bg-premium-dark">
                            </i>
                        </div>
                        <div>
                            Add Category
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form action="{{ route('blog.store') }}" method="POST" class="needs-validation"
                                        novalidate>
                                        @csrf
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Title</label>
                                            <input id="validationCustom01" name="title" placeholder="Title" required
                                                type="text" class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Meta Title</label>
                                            <input id="validationCustom01" name="meta_title" placeholder="Meta Title"
                                                required type="text" class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Meta Keyword</label>
                                            <input id="validationCustom01" name="meta_keyword" placeholder="Meta Keyword"
                                                required type="text" class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="exampleSelect" class="">Category</label>
                                            <select name="parent" class="form-control">
                                                <option value="0">Please Select</option>
                                                @foreach ($allcategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label class="">Meta Description</label>
                                            <textarea name="meta_description" placeholder="Meta Description" required
                                                class="form-control"></textarea>
                                        </div>

                                        <div class="position-relative form-group">
                                            <label class=""> Description</label>
                                            <textarea name="description" placeholder="Description" required
                                                class="form-control"></textarea>
                                        </div>
                                        <button class="mt-1 btn btn-primary">Save</button>
                                    </form>
                                    <script>
                                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                                        (function() {
                                            'use strict';
                                            window.addEventListener('load', function() {
                                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                var forms = document.getElementsByClassName('needs-validation');
                                                // Loop over them and prevent submission
                                                var validation = Array.prototype.filter.call(forms, function(
                                                    form) {
                                                    form.addEventListener('submit', function(event) {
                                                        if (form.checkValidity() === false) {
                                                            event.preventDefault();
                                                            event.stopPropagation();
                                                        }
                                                        form.classList.add('was-validated');
                                                    }, false);
                                                });
                                            }, false);
                                        })();

                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop

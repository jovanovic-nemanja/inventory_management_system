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
                        <div>Add Category
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
                                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
                                        class="needs-validation" novalidate>
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
                                            <label for="validationCustom01" class="">Meta Keywords</label>
                                            <input id="validationCustom01" name="meta_keywords" placeholder="Meta Keywords"
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
                                            <textarea name="meta_description" placeholder="Meat Description" required
                                                class="form-control"></textarea>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label class=""> Description</label>
                                            <textarea name="description" placeholder="Description" id="myTextarea" required
                                                class="form-control"></textarea>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Image</label>
                                            <input id="gallery-photo-add" required="" class="form-control" name="image"
                                                type="file">
                                            <div class="gallery"></div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
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
                                        $(function() {
                                            var imagesPreview = function(input, placeToInsertImagePreview) {

                                                if (input.files) {
                                                    var filesAmount = input.files.length;
                                                    for (i = 0; i < filesAmount; i++) {
                                                        var reader = new FileReader();
                                                        reader.onload = function(event) {
                                                            $($.parseHTML('<img>')).attr('src', event.target
                                                                .result).appendTo(
                                                                placeToInsertImagePreview);
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }

                                            };
                                            $('#gallery-photo-add').on('change', function() {
                                                $(".gallery img:last-child").remove()
                                                imagesPreview(this, 'div.gallery');
                                            });
                                        });

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

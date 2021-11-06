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
                        <div>Edit Post
                            <div class="page-title-subheading">Wide selection of forms controls, using the
                                Bootstrap 4 code base, but built with React.
                            </div>
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
                                    <form action="{{ route('post.update', $category->id) }}" method="POST"
                                        enctype="multipart/form-data" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Title</label>
                                            <input id="validationCustom01" name="title" value="{{ $category->title }}"
                                                required type="text" class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Meta Title</label>
                                            <input id="validationCustom01" name="meta_title" placeholder="Meta Title"
                                                value="{{ $category->meta_title }}" required type="text"
                                                class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label for="validationCustom01" class="">Meta Keywords</label>
                                            <input id="validationCustom01" name="meta_keywords" placeholder="Meta Keywords"
                                                value="{{ $category->meta_keywords }}" required type="text"
                                                class="form-control">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                        <div class="position-relative form-group">
                                            <label for="exampleSelect" class="">Category</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($allcategories as $cat)
                                                    @if ($cat->id == $category->category_id)
                                                        <option selected="" value="{{ $cat->id }}">{{ $cat->title }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label class="">Meta Description</label>
                                            <textarea name="meta_description" placeholder="Meat Description" required
                                                class="form-control">{{ $category->meta_description }}</textarea>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label class=""> Description</label>
                                            <textarea name="description" required id="myTextarea"
                                                class="form-control">{{ $category->description }}</textarea>
                                        </div>
                                        <div class="position-relative form-group">
                                            <label>Product Image:</label>
                                            <input type="file" name="image" id="gallery-photo-add" class="form-control" />
                                            <div class="gallery">
                                                <img class="img-fluid" width="200"
                                                    src="{{ asset('uploads/') }}/{{ $category->image }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="mt-1 btn btn-primary">Update</button>
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

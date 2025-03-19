@extends('backend.layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
     <!-- Include Bootstrap CSS (needed for Tags Input) -->
     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

     <!-- Include Bootstrap Tags Input CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet">
 <style>
    .bootstrap-tagsinput {
            width: 100% !important;

        }
        .tag{
            color: black !important;
            background-color: lightgray !important;
            padding: 5px;
            margin-left: 10px;
        }
 </style>
@endpush
@section('content')
 <!-- main  content -->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>New Post</h1>
                <p>Table to display analytical data effectively</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i>
                </li>
                <li class="breadcrumb-item "><a href="{{route('posts')}}">Blogs</a></li>
            </ul>
        </div>
        <form id="blogForm" class="form-horizontal" action="{{route('blog_store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="control-label">Category</label>
                                    <select name="category_id" type="text" id="category_id" id="mySelect" class="form-control">
                                        <option value="">Select a category</option> 
                                        @foreach($categories as $category)
                                        @if($category->status == 1) 
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="control-label">Title</label>
                                    <input class="form-control error" id="title" name="title" type="text" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="control-label">Tag</label>
                                    <input class="form-control tag bootstrap-tagsinput"  data-role="tagsinput"  name="tags" type="text" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="control-label">Description</label>
                                    <textarea id="description" class="summernote" rows="4" name="description" placeholder="Enter your Description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <label class="control-label">Attachment</label>
                                    <div>
                                        <input class="form-control" name="file[]" id="file" type="file">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label"><br></label>
                                    <button type="button" class="btn btn-sm btn-info" id="add-file-button" style="display: block;padding:5px">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                <label class="control-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>                                     
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('js')


<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include Bootstrap Tags Input JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter your Description',
                tabsize: 2,
                height: 150
            });
            
            var fileInputIndex = 1;
            $('#add-file-button').click(function() {
                var newFileInput = `
                    <div class="form-group row" id="file-input-${fileInputIndex}">
                        <div class="col-md-11">
                            <input class="form-control" name="file[]" type="file">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-danger remove-file-button" data-index="${fileInputIndex}" style="display: block;padding:5px">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
                $(this).closest('.form-group').after(newFileInput);
                fileInputIndex++;
            });

            $(document).on('click', '.remove-file-button', function() {
                var index = $(this).data('index');
                $('#file-input-' + index).remove();
            });

        $('#blogForm').validate({
            rules: {
                category_id: {
                    required: true,
                },
                title: {
                    required: true,
                    minlength: 3,
                },
                description: {
                    required: true,
                    minlength: 10,
                },
                'file[]': {
                    required: true,
                    extension: "jpg|jpeg|png|pdf|docx",
                    filesize: 2048,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                category_id: {
                    required: "Please select a category",
                },
                title: {
                    required: "Please enter a title",
                    minlength: "Title must be at least 3 characters",
                },
                description: {
                    required: "Please provide a description",
                    minlength: "Description must be at least 10 characters long",
                },
                'file[]': {
                    required: "Please upload at least one file",
                    extension: "Only jpg, jpeg, png, pdf, docx files are allowed",
                    filesize: "File size should not exceed 2MB",
                },
                status: {
                    required: "Please select the status",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $.validator.addMethod("filesize", function(value, element, param) {
            var file = element.files[0];
            if (file) {
                var fileSizeInKB = file.size / 1024;
                return fileSizeInKB <= param;
            }
            return true;
        }, "File size must be less than 2MB.");


    });
</script>


<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('#mySelect').select2({
        placeholder: "Search items...",
        minimumInputLength: 2,  // Minimum characters before triggering the search
        ajax: {
            url: '/api/items/search',  // Your Laravel route
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term  // Send search query as `q`
                };
            },
            processResults: function (data) {
                return {
                    results: data.items  // Return the items in the format Select2 expects
                };
            }
        }
    });
});

</script>




@endpush

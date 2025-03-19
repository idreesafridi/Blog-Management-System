@extends('backend.layouts.master')
@push('css')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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
 </style>
@endpush
@section('content')
  <!-- main  content -->
  <main class="app-content">
<div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Blogs</h1>
      <p>Table to display analytical data effectively</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i>
      </li>
      <li class="breadcrumb-item "><a href="{{route('posts')}}">Blogs</a></li>
    </ul>
  </div>
</div>
{{-- @dd($blogs) --}}
<form action="{{route('blog_update',$blog->id)}}" method="POST" id="blogForm" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label">Category</label>
                            <select name="category_id" type="text" id="category_id" class="form-control">
                                <option value="">Select a category</option> 
                                @foreach($categories as $category)
                                @if($category->status == 1)
                                    <option value="{{ $category->id }}" @if($category->id==$blog->category_id) selected @endif>{{ $category->name }}</option>
                                @endif
                                    @endforeach
                            </select>
                           
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label">Title</label>
                            <input class="form-control " id="title"  value="{{$blog->title}}" name="title" type="text" placeholder="Enter Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                           
                         <label class="control-label">Tag</label>
                        <input class="form-control bootstrap-tagsinput" 
                            data-role="tagsinput" 
                            value="{{ $blog->blogtag->pluck('name')->implode(', ') }}" 
                            name="tags" 
                            type="text" 
                            placeholder="Enter tags">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label">Description</label>
                            <textarea id="description" class="summernote"  rows="4" value="{{$blog->description}}" name="description" placeholder="Enter your Description">{{$blog->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-11">
                            <label class="control-label">Attachments</label>
                            <div>
                                @foreach ($blog->blogAttachments as $blogAttachment)
                                    <img src="{{asset('website')}}/{{$blogAttachment->file??"blog_attachments/no_image.png"}}" style="height: 50px;" >                                
                                @endforeach

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
                                        <!-- Dynamically set the initial status -->
                                        <option value="1" @if($blog->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($blog->status == 0) selected @endif>Inactive</option>
                                    </select>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <div class="row">
                    <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        <a class="btn btn-secondary" href="{{route('posts')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
    });

</script>
@endpush
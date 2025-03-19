@extends('backend.layouts.master')
@push('css')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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


                .status {
          font-size: 14px;
          background-color: #f8f9fa; /* Optional: light background for the status */
          padding: 10px;
          border-radius: 5px; /* Optional: rounded corners */
        }

        .comment-details {
          flex-grow: 1; /* Ensures comment area takes the remaining space */
        }



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
      <li class="breadcrumb-item active"><a href="{{route('posts')}}">Blogs</a></li>
    </ul>
  </div>
</div>
{{-- @dd($blogs) --}}
<div class="row user">
<div class="col-md-12">
    <div class="tab-content">
      <div class="tab-pane active" id="user-timeline">
        <div class="timeline-post">
          <div class="post-media"><a href="#"><img src="{{asset('website')}}/{{$blogs->blogAttachment->file??"blog_attachments/no_image.png"}}" style="height: 50px;" ></a>
            <div class="content">
              <h5><a href="#">{{$blogs->category->name}}</a></h5>
              <p class="text-muted"><small>{{$blogs->created_at->format(env('GLOBALE_DATE_FORMAT'))}} </small></p>
            </div>
          </div>
          <div class="post-content">
            <p>{!!$blogs->description!!}</p>
              <p data-role="tagsinput">
                    @foreach($blogs->blogtag as $tag)
                        <span  class="tag bootstrap-tagsinput">{{ $tag->name }}</span>
                    @endforeach
              </p>

          </div>
          <ul class="post-utility">
            <li class="likes">  <a type="submit" > <i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>{{ $blogs->Bloglikes()->count() ?? 0 }}  Like</a></li>
            <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
            <li type="button" class="view_comment_button" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-fw fa-lg fa-comment-o"></i> 
              {{ $blogs->comments->count() }}  Comments</li>
              
    
          </ul>
        </div>
    </div>
</div>
</div>


</main>

{{-- <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Blog Comments</h5>
     
        <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          @foreach ($blogcomments as $comment)
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ $comment->name }}</h5>
              <p class="card-text">{{ $comment->comment }}</p>
              <small class="text-muted">Posted on: {{ $comment->created_at->format('F j, Y, g:i a') }}</small>
           
                <p class="card-text"><strong>Status:</strong> {{ $comment->status }}</p>
             
            </div>
            
          </div>
          @endforeach
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div> --}}

<div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Blog Comments</h5>
     
        <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        @foreach ($blogcomments as $comment)
          <div class="card mb-3">
            <div class="card-body d-flex flex-column flex-md-row-reverse">
              <!-- Status (Right Side) -->
              <div class="status mb-3 mb-md-0 pl-md-3 order-md-1">
                <p class="card-text"><strong>Status:</strong> {!!$comment->commentStatusText!!}</p>
              </div>
              
              <!-- Comment Details (Left Side) -->
              <div class="comment-details order-md-2">
                <h5 class="card-title">{{ $comment->name }}</h5>
                <p class="card-text">{{ $comment->comment }}</p>
                <small class="text-muted">Posted on: {{ $comment->created_at->format('F j, Y, g:i a') }}</small>
              </div>

            </div>
          </div>
        @endforeach
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>






    
@endsection
@push('js')

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

    $(document).on('click','.close_modal',function(){
    $('#comment_modal').modal('hide');

  });
  $(document).on('click','.view_comment_button',function(){
    $('#comment_modal').modal('show');
  });
</script>


@endpush
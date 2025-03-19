@extends('backend.layouts.master')
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
        <li class="breadcrumb-item active"><a href="{{route('posts_create')}}">Create</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Category</th>
                  {{-- <th>Date</th> --}}
                  <th>Status</th>
                  <th >Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($blogs as $key=>$blog)
                <tr>
                  <td>{{++$key}}</td>
                  <td><img src="{{asset('website')}}/{{$blog->blogAttachment->file??"blog_attachments/no_image.png"}}" style="height: 30px;" ></td>
                  {{-- <td>{{$blog->title}}</td> --}}
                  <td>{{ substr($blog->title, 0, 50) }}...</td>
                  <td>{{$blog->category->name??"Not Available"}}</td>
                  {{-- <td>{{$blog->created_at->format(env('GLOBALE_DATE_FORMAT'))}}  </td> --}}
                  <td>{!!$blog->blogStatusText!!}</td>
                  <td>
                    <a class="btn btn-success btn-sm" href="{{route('blog_view',$blog->id)}}"><i class="fa fa-eye"></i> </a>
                    <a class="btn btn-info btn-sm" href="{{route('blog_edit',$blog->id)}}"><i class="fa fa-pencil"></i> </a>
                
                       <form action="{{ route('blog_destroy', $blog->id) }}" method="POST"  style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button  class="btn btn-danger btn-sm"  type="submit"><i class="fa fa-trash"></i></button>
                    </form> 
                  </td>     
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- main content start -->
    
@endsection
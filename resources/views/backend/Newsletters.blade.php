@extends('backend.layouts.master')
@section('content')

  <!-- main  content -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Newsletters</h1>
        <p>Start a beautiful journey here</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{route('newsletters')}}">Newsletters</a></li>
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
                  <th>Email</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($news as $new)
                <tr>
                  <td>{{$new->id}}</td>
                  <td>{{$new->email}}</td>
                  <td>{{$new->created_at->format('d F Y h:i A')}}  </td>
                  <td>
                      <form action="{{ route('news_destroy', $new->id) }}" method="POST" style="display:inline;">
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
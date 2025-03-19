@extends('backend.layouts.master')
@section('content')

<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Profile</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Profile</a></li>
        </ul>
      </div>
    {{-- <p>{{$users->name}}</p> --}}
    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Profile Detail</h3>
            <div class="tile-body">
              <form action="{{route('profile_update')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div>
                        <img src="{{asset('website')}}/{{$user->profile_image}}" alt="First slide" style="height: 100px;">
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" type="text" name="name" placeholder="Enter full name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="email" name="email" placeholder="Enter email address" value="{{$user->email}}">
                </div>
                <div class="form-group" >
                  <label class="control-label">Image</label>
                  <input class="form-control" type="file" name="file">
                </div>
                {{-- <div class="form-group">
                  <label class="control-label">Address</label>
                  <textarea class="form-control" rows="4" placeholder="Enter your address"></textarea>
                </div> --}}
             
            </div>
            <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('dashboard')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </form>
            </div>
          </div>
        </div>
    </div>
    </main>

@endsection
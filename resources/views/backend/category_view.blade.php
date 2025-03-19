@extends('backend.layouts.master')
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Categories</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="{{route('categories')}}">Categories</a></li>
          
        </ul>
      </div>
    </div>
      <form action=""  class="form-horizontal">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="parent_category_id" class="col-form-label">Parent Category:</label>
                                <select class="form-control"  name="parent_category_id">
                                    @foreach($categories->where('parent_category_id',null) as $category)
                                      <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    
                                  </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" readonly id="name" name="name" required value="{{$categories->name}}">
                              </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                    <label for="status" class="col-form-label">Status</label>
                                    <input type="text" class="form-control" readonly id="name" name="name" required value="{!!$categories->categoryStatusText!!}">
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <a class="btn btn-secondary" href="{{route('categories')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
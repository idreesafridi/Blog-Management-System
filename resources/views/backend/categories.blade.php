@extends('backend.layouts.master')
@section('content')

  <!-- main  content -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Categories</h1>
        <p>Start a beautiful journey here</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="{{route('categories')}}">Categories</a></li>
        <li  class="breadcrumb-item active">
          <a href="#" class="create_category_button">Create</a>
        </li>
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
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as  $key=>$category)
                <tr>
                  <td>{{++$key}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->created_at->format(env('GLOBALE_DATE_FORMAT'))}}  </td>
                  <td>{!!$category->categoryStatusText!!}</td>
                  <td>
                    <a href="#" class="view_category_button btn btn-success btn-sm" parent_category_id="{{$category->parent_category_id}}"  category_id="{{$category->id}}"  category_name="{{$category->name}}"  category_status="{{$category->status}}"><i class="fa fa-eye"></i> </a>
                    <a href="#" class="edit_category_button btn btn-info btn-sm" parent_category_id="{{$category->parent_category_id}}"  category_id="{{$category->id}}"  category_name="{{$category->name}}"  category_status="{{$category->status}}" ><i class="fa fa-pencil"></i></a>
              
                      <form action="{{ route('category_destroy', $category->id) }}" method="POST"  style="display:inline;">
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
  
  <div class="modal fade" id="create_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category_create')}}" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                  @csrf
                  <div class="form-group">
                    <label for="parent_category_id" class="col-form-label">Parent Category:</label>
                    <select class="form-control" name="parent_category_id">
                      <option value="">Select Parent Category</option>
                      @foreach($categories->where('parent_category_id',null) as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name" class="col-form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select class="form-control" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
            
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- update model --}}
  <div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category_update')}}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="category_id" id="edit_category_id" >
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                  @csrf
                  <div class="form-group">
                    <label for="parent_category_id" class="col-form-label">Parent Category:</label>
                    <select class="form-control" id="edit_parent_category_id" name="parent_category_id">
                      <option value="">Select Parent Category</option>
                      @foreach($categories->where('parent_category_id',null) as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control"  id="edit_category_name" name="name" required value="">
                  </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select class="form-control" id="edit_category_status" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    
                            
                  </div>
            
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  {{-- view model --}}
  <div class="modal fade" id="view_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="">
         
          <input type="hidden" name="category_id" id="view_category_id" >
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                  @csrf
                  <div class="form-group">
                    <label for="parent_category_id" class="col-form-label">Parent Category:</label>
                    <select class="form-control" id="view_parent_category_id" name="parent_category_id">
                      <option value="">Select Parent Category</option>
                      @foreach($categories->where('parent_category_id',null) as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control"  id="view_category_name" name="name" required value="">
                  </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select class="form-control" id="view_category_status" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    
                            
                  </div>
            
              </div>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>


@endsection

@push('js')
<script>
  $(document).on('click','.close_modal',function(){
    $('#create_category_modal').modal('hide');
    $('#edit_category_modal').modal('hide');
    $('#view_category_modal').modal('hide');

  });
  $(document).on('click','.create_category_button',function(){
    $('#create_category_modal').modal('show');
  });
  $(document).on('click','.edit_category_button',function(){
    var parent_category_id = $(this).attr('parent_category_id');
    var category_id = $(this).attr('category_id');
    var category_name = $(this).attr('category_name');
    var category_status = $(this).attr('category_status');
    $('#edit_parent_category_id').val(parent_category_id);
    $('#edit_category_id').val(category_id);
    $('#edit_category_name').val(category_name);
    $('#edit_category_status').val(category_status);

    $('#edit_category_modal').modal('show');
  });

  $(document).on('click','.view_category_button',function(){
    var parent_category_id = $(this).attr('parent_category_id');
    var category_id = $(this).attr('category_id');
    var category_name = $(this).attr('category_name');
    var category_status = $(this).attr('category_status');
    $('#view_parent_category_id').val(parent_category_id);
    $('#view_category_id').val(category_id);
    $('#view_category_name').val(category_name);
    $('#view_category_status').val(category_status);

    $('#view_category_modal').modal('show');
  });
</script>
@endpush

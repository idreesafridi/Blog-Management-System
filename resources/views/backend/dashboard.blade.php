@extends('backend.layouts.master')
@push('css')
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@endpush
@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        <p>A free and open source Bootstrap 4 admin template</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i  class="icon fa fa-blog fa-3x"></i>
          <div class="info">
            <h4>BLOGS</h4>
            <p><b>{{$blogs->count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-list fa-3x"></i>
          <div class="info">
            <h4>CATEGORIES</h4>
            <p><b>{{$categories->count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fas fa-envelope fa-3x"></i>
          <div class="info">
            <h4>NEWSLETTERS</h4>
            <p><b>{{$newsletters->count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fas fa-phone-alt fa-3x"></i>
          <div class="info">
            <h4>CONTACTS</h4>
            <p><b>{{$contacts->count()}}</b></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Categories</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="categoriesChartDetail"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Blogs</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="blogsChartDetail"></canvas>
          </div>
        </div>
      </div>
    </div>
   
  </main>
@endsection

@push('js')
<script type="text/javascript">
  
  var blogsData = [
    {
      value: {{$blogs->where('status',1)->count()}},
      color: "#46BFBD",
      highlight: "#5AD3D1",
      label: "Active Blogs"
    },
    {
      value: {{$blogs->where('status',0)->count()}},
      color:"#F7464A",
      highlight: "#FF5A5E",
      label: "Inactive Blogs"
    }
  ]
  var ctxp = $("#blogsChartDetail").get(0).getContext("2d");
  var pieChart = new Chart(ctxp).Pie(blogsData);


  var categoriesData = [
    {
      value: {{$categories->where('status',1)->count()}},
      color: "#46BFBD",
      highlight: "#5AD3D1",
      label: "Active Categories"
    },
    {
      value: {{$categories->where('status',0)->count()}},
      color:"#F7464A",
      highlight: "#FF5A5E",
      label: "Inactive Categories"
    }
  ]
  
  
  var ctxp = $("#categoriesChartDetail").get(0).getContext("2d");
  var pieChart = new Chart(ctxp).Pie(categoriesData);

</script>

@endpush
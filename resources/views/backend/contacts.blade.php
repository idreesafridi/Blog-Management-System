@extends('backend.layouts.master')
@section('content')

  <!-- main  content -->
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Contacts</h1>
        <p>Start a beautiful journey here</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{route('contacts')}}">Contacts</a></li>
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
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Message</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                          <td>{{$contact->id}}</td>
                          <td>{{$contact->name}}</td>
                          <td>{{$contact->email}}</td>
                          <td>{{$contact->phone}}</td>
                          <td>{{$contact->message}}</td>
                          <td>{{$contact->created_at->format(env('GLOBALE_DATE_FORMAT'))}}</td>
                          <td> 
                               <form action="{{ route('contact_destroy', $contact->id) }}" method="POST" style="display:inline;">
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


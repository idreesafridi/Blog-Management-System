<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Blog Management System">
    <title>Blog Management System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .error{color: red}
    </style>
    @stack('css')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="{{url('/')}}">Blog Management</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">You have 4 new notifications.</li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a></li>
              
              </div>
            </div>
            <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">{{ auth()->user()->name }}  &nbsp; <i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{route('profile_edit')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="width: 50px; height: 50px;" src="{{asset('website')}}/{{Auth::user()->profile_image}}"   alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          {{-- <p class="app-sidebar__user-designation">Frontend Developer</p> --}}
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item  {{Request::is('dashboard')?'active':''}}" href="{{route('dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item {{Request::is('categories')?'active':''}}" href="{{route('categories')}}" ><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Categories</span></a>
        </li>
        <li class="treeview"><a class="app-menu__item {{Request::is('*blog*')?'active':''}}" href="{{route('posts')}}" ><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Blogs</span></a>
          <ul class="treeview-menu">
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item {{Request::is('*newsletters*')?'active':''}}" href="{{route('newsletters')}}" ><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Newsletters</span></a>
        </li>
        <li class="treeview "><a class="app-menu__item {{Request::is('contacts*')?'active':''}}" href="{{route('contacts')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Contacts</span></a>
        </li>
        <hr style="border: 0.5px solid #ffffff">
        <li class="treeview "><a class="app-menu__item " href="{{url('logout')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Logout</span></a>
        </li>
      </ul>
    </aside>


    @yield('content')



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{asset('backend/js/plugins/chart.js')}}"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      @if(Session::has('msg'))
        Swal.fire({
          icon: "{{Session::get('type')}}",
          title: "{{Session::get('title')}}",
          text: "{{Session::get('msg')}}",
          showConfirmButton: false,
          timer: 1500
        });
      @endif

    </script>

    @stack('js')
  </body>
</html>
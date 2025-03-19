<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page - Blogger</title>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <!-- bootstrap css-->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.css') }}">
    <!-- animate on scroll (aos) css-->
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('website/css/font-awesome.min.css') }}">
    <!-- main style sheet -->
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    <!-- favicon -->
    <link href="{{ asset('website/img/favicon.png') }}" rel=icon type=image/x-icon> 
    @stack('css')
</head> 
    <body>
    <header class="header">
        
        <div class="navigation">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('website/img/favicon.png') }}" alt="logo" class="header-logo">
                </a>
                <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{Request::is('/')?'active':''}}">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        {{-- <li class="nav-item {{Request::is('blog')?'active':''}}">
                            <a class="nav-link" href="{{url('blog')}}">Blogs</a>
                        </li> --}}
                        <li class="nav-item {{Request::is('contact')?'active':''}}">
                            <a class="nav-link" href="{{url('contact')}}">Contact</a>
                        </li>
                        @foreach($categories->where('parent_category_id',"") as $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                                    data-toggle="dropdown">
                                {{$category->name}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($category->children as $child)
                                        <a class="dropdown-item" href="{{route('category_wise',$category->id)}}">{{$child->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                        <li class="nav-item">
                            @if(Auth::user())
                                <a class="nav-link" href="{{url('dashboard')}}">Dashboard</a>
                            @else
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header-main">
            <div class="container-fluid">
                <div class="row">
                    @if($blogs->count()>0)
                        @foreach($blogs->random(3) as $blog)
                            <div class="col-md-4 col-sm-6 mx-auto no-padding">
                                <div class="header-main__content">
                                    <img src="{{ asset('website') }}/{{$blog->blogAttachment->file}}" alt="header main image one" class="header-main__image">
                                    <div class="header-main__text">
                                        <h3 class="heading-quaternary mb-4"><a href="blog-post.html">{{$blog->category->name}}</a></h3>
                                        <div class="header-main__link">
                                            <h5>{{$blog->created_at->format(env('GLOBALE_DATE_FORMAT_WITH_MONTH_NAME'))}}</h5>
                                            <div class="heading-main__icon">
                                                <form action="{{route('like',$blog->id)}}" method="POST">
                                                    @csrf
                                               <button class="like-button btn btn-danger" type="submit" > <i class="fa fa-heart"></i>{{ $blog->Bloglikes()->count() ?? 0 }}</button>
                                               
                                            </form> 
                                            <button class="btn btn-outline-primary"><i class="fa fa-bookmark-o" title="Book Mark"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of header main contant-->
                            </div><!-- end of image one -->
                        @endforeach
                    @endif    
                    
                </div><!-- end of row -->
            </div>
        </div><!-- end of header-main -->
    </header>
    <!-- end of header section -->

   @yield('content')
   

    <!-- footer section -->
    <footer class="footer">
        <!--Footer main container-->
        <div class="container">
            <div class="footer__main">
                <div class="row">
                    <!-- column one -->
                    <div class="col-md-4 col-sm-12 mx-auto">
                        <div class="footer__main--content">
                            <!-- Hotel chain group details -->
                            <h6 class="heading-tag">Blogger News Magazine</h6>
                            <p class="footer__main--text">Vestibulum eleifend lacinia felis eget laoreet. Ut egestas,
                                diam non efficitur accumsan, orci sem blandit risus, sed auctor orci ante in ligula.
                                Mauris ac scelerisque turpis. </p>
                            <div class="footer__end--copy">
                                &copy; Blogger News Magazine, All Rights Reserved
                            </div>
                        </div>
                    </div>
                    <!-- column two links -->
                    <div class="col-md-4 col-sm-12 mx-auto">
                        <div class="footer__main--content">
                            <h6 class="heading-tag">Quick Links</h6>
                            <ul>
                                <li class="footer__main--link">
                                    <a href="index.html">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Home Page - Blogger Magazine</span>
                                    </a>
                                </li>

                                <li class="footer__main--link">
                                    <a href="javascript:;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Politics - Latest News</span>
                                    </a>
                                </li>

                                <li class="footer__main--link">
                                    <a href="javascript:;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Fashion - Updates</span>
                                    </a>
                                </li>

                                <li class="footer__main--link">
                                    <a href="javascript:;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Health - Tips</span>
                                    </a>
                                </li>

                                <li class="footer__main--link">
                                    <a href="contact-us.html">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Contact Us</span>
                                    </a>
                                </li>

                                <li class="footer__main--link">
                                    <a href="javascript:;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Terms &amp; Conditions </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- column three Subscribtion form -->
                    <div class="col-md-4 col-sm-12 mx-auto">
                        <div class="footer__main--content">
                            <h6 class="heading-tag">Newsletters &amp; Offers </h6>
                            <p class="footer__main--text">We send you weekly trending news and trends through
                                newletters. Subscribe to receive details in your inbox.
                            </p>
                            <form action="{{route('create_newletters')}}" method="POST">
                                @csrf
                                <input class="footer__form" type="email" name="email" placeholder="Email Address">
                                <button type="submit" class="btn__cta">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Footer main container-->
    </footer>
    <!--End of Footer section-->

    <!--jquery-3.3.1 js-->
    <script src="{{ asset('website/js/jquery.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ asset('website/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>

    <!-- sticky side bar -->
    <script src="{{ asset('website/js/ResizeSensor.min.js') }}"></script>
    <script src="{{ asset('website/js/theia-sticky-sidebar.min.js') }}"></script>

    <!-- PARTICLES JS -->
    <script src="{{ asset('website/js/aos.js') }}"></script>

    <!-- coustom js -->
    <script src="{{ asset('website/js/main.js') }}"></script>
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
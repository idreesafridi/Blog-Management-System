@extends('website.layouts.master')

@section('content')

 <!-- main section -->
 <section class="main section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <div class="theiaStickySidebar">
                    <div class="main__content">
                        <img src="{{ asset('website/img/politics-02.jpg') }}" alt="header main image one" class="main__image">
                        <div class="main__text">
                            <h3 class="heading-tertiary mb-4"><a href="blog-post.html">Most exclusive report of
                                    political impact on people's lives in 2019.</a></h3>
                            <div class="main__link">
                                <h5>May, 15 2019</h5>
                                <div class="main__icon">
                                    <i class="fa fa-heart-o mr-4" title="Favorite"></i>
                                    <i class="fa fa-bookmark-o" title="Book Mark"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end of header main contant-->
                   
                    @if($blogs->count()>0)
                   
                        @foreach($blogs as $key=>$blog)
                            @if($key==0)
                                <div class="main__subcard">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mx-auto align-self-center">
                                            <div class="main__subcard--text">
                                                <h3 class="heading-quaternary weight">{{$blog->category->name}}</h3>
                                                <p class="paragraph">{{$blog->title}}</p>
                                                <div class="main__link">
                                                    <p class="heading-tag"><a href="{{url('blog_detail',$blog->id)}}">Read More <i
                                                                class="fa fa-arrow-right"></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mx-auto">
                                            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($blog->blogAttachments as $i=>$item)
                                                        <div class="carousel-item {{$i==0?'active':''}}">
                                                            <img class="d-block w-100" src="{{asset('website')}}/{{$item->file}}" alt="First slide">
                                                        </div>                                                    
                                                    @endforeach                                                
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselControls" role="button"
                                                    data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselControls" role="button"
                                                    data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of main subcard -->
                            @else
                                @if($key==1)    
                                <div class="row mt-5">
                                @endif
                                    <div class="col-md-6 col-sm-12 mx-auto">
                                        <div class="card">
                                            <img class="card-img-top" src="{{asset('website')}}/{{$blog->blogAttachment->file}}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="heading-tag">{{$blog->category->name}}</h5>
                                                <p class="card-text">{{$blog->title}}</p>
                                                <button class="btn-blogger" onclick="location.href='{{url('blog_detail',$blog->id)}}';">Read
                                                    More</button>
                                            </div>
                                        </div>
                                    </div>

                                @if($loop->last)
                                </div>
                                @endif
                            @endif

                        @endforeach
                    @endif
                 
                </div>
            </div><!-- end of main content-->

            



            <div class="col-md-4 col-sm-10 mx-auto sidebar">
                <div class="theiaStickySidebar">
                    <!--Blog page right sidebar-->
                    <aside class="main__sidebar">
                        <!--Blog Post search box-->
                        <div class="main__search">
                            <form class="search-form">
                                <input type="search" placeholder="What do you want to Search?">
                                <button class="btn btn-search" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!--End of Blog Post search box-->

                        

                        <!--Blog categories section-->
                        <div class="main__category">
                            <h3 class="heading-tertiary">Categories</h3>
                            <hr>
                            @if ($categories->count()>0)
                                
                                @foreach ($categories->random(5) as $category )
                                    
                                <ul class="main__category--list">

                                    <li class="main__category--item">
                                        <a href="{{route('category_wise',$category->id)}}">
                                            <span>{{$category->name}}</span>
                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    
                                </ul>
                                
                                @endforeach
                            @endif
                        </div>
                        <!--End of Blog categories section-->

                        <!--Recent blog section-->
                        <div class="main__recent">
                            <h3 class="heading-tertiary">Recent Posts </h3>
                            <hr class="style-main-thin">
                            <div class="main__recent--list">
                                @if ($blogs->count()>0)

                                    @foreach($blogs->random(3) as $blog)
                                    <img src="{{asset('website')}}/{{$blog->blogAttachment->file??"blog_attachments/no_image.png"}}" alt="post image one" class="main__recent--img">
                                    <div class="main__recent--details">
                                        <a href="{{url('blog_detail',$blog->id)}}">
                                            <h4 class="heading-hover">{{$blog->title}}</h4>
                                        </a>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span class="main__recent--contact">Created on: {{ $blog->created_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!--End of Recent blog section-->
                        <!--Blog Post tags-->
                        <div class="main__tags">
                            <h3 class="heading-tertiary">Tags</h3>
                            <hr class="style-main-thin">
                            <ul class="main__tags--list">
                                @foreach($tags as $tag)
                                    <li class="main__tags--item"><a href="{{route('blog_tagdetails',$tag->id)}}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End of Blog Post tags-->
                    </aside>
                    <!--End of side section-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of main section -->

@endsection

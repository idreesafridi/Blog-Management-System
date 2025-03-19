@extends('website.layouts.master')

@section('content')
<section class="main section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <div class="theiaStickySidebar">
                    <div class="main__post">
                        <h1 class="heading-primary mb-5">{{$blogs_tag->category->name}}</h1>
                        @foreach ($blogs_tag->blogAttachments as $i=>$item)
                        <div class="main__content mb-5{{$i==0?'active':''}}">
                            <img class="d-block w-100" src="{{asset('website')}}/{{$item->file}}" alt="First slide" class="main__image">
                        </div>                                                  
                    @endforeach 
                    {{-- banner section --> --}}
                    <section class="main-banner">
                        <div class="main-banner__content">
                            
                            <h1 class="heading-secondary">{{$blogs_tag->title}}
                            </h1>
                        </div>
                    </section>

                        <p class="paragraph">{!!$blogs_tag->description!!}</p>

                        
                        <h3 class="heading-tertiary">Tags</h3>
                        <hr>
                        <ul class="main__tags--list">
                           
                                @foreach($blogs_tag->blogtag as $tag)
                                    {{-- <span  class="tag bootstrap-tagsinput">{{ $tag->name }}</span> --}}
                                    <li class="main__tags--item"><a href="">{{ $tag->name }}</a></li>
                                @endforeach
                          
                            
                        </ul>
                    </div><!-- end of main post -->
                </div>
            </div><!-- end of main content-->

            <div class="col-md-4 col-sm-10 mx-auto sidebar">
                <div class="theiaStickySidebar">
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
                            @foreach ($categories->random(5) as $category )
                                
                            <ul class="main__category--list">

                                <li class="main__category--item">
                                    <a href="#">
                                        <span>{{$category->name}}</span>
                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                
                            </ul>
                            
                            @endforeach
                        </div>
                        <!--End of Blog categories section-->

                        <!--Recent blog section-->
                        <div class="main__recent">
                            <h3 class="heading-tertiary">Recent Posts </h3>
                            <hr class="style-main-thin">
                            <div class="main__recent--list">
                                {{-- @foreach($blogs_tag->random(3) as $blog)
                                <img src="{{asset('website')}}/{{$blog->blogAttachment->file??"blog_attachments/no_image.png"}}" alt="post image one" class="main__recent--img">
                                <div class="main__recent--details">
                                    <a href="{{url('blog_detail',$blog->id)}}">
                                        <h4 class="heading-hover">{{$blog->title}}</h4>
                                    </a>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span class="main__recent--contact">Created on: {{ $blog->created_at->format('Y-m-d H:i') }}</span>
                                </div>
                                @endforeach --}}
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
@endsection
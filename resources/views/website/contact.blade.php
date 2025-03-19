@extends('website.layouts.master')

@section('content')

   <!-- main section -->
   <section class="main section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <div class="theiaStickySidebar">
                    <div class="main__post">
                        <h1 class="heading-secondary mb-5">Have a Question? Write to Us</h1>
                        <!--Contact form-->
                        <form action="{{route('contact_create')}}" class="form" method="POST">
                            @csrf
                            <div class="form__group">
                                <input type="text" class="form__input" placeholder="Name" id="name" name="name" required>
                                <label for="name" class="form__label">Name</label>
                            </div>
                            <div class="form__group">
                                <input type="email" class="form__input" placeholder="Email" id="email" name="email" required>
                                <label for="email" class="form__label">Email</label>
                            </div>
                            <div class="form__group">
                                <input type="tel" class="form__input" placeholder="Phone No" id="number" name="number">
                                <label for="number" class="form__label">Phone No</label>
                            </div>
                            <div class="form__group">
                                <textarea class="form__input" placeholder="Message" rows="4"
                                    data-form-field="Message" id="message" name="message"></textarea>
                                <label for="message" class="form__label">Message</label>
                            </div>
                            <button type="submit" class="btn-blogger">Send Message</button>
                        </form>
                        <!--End of contact form-->
                    </div><!-- end of main post -->
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

                        <!-- author section sidebar -->
                        <div class="main__author">
                            <img src="{{ asset('website/img/author-01.jpg') }}" alt="author image" class="main__author--image">
                            <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                                vitae
                                nisl nunc. Curabitur hendrerit neque lacinia eros euismod mollis. Pellentesque
                                cursus
                                lorem eros, non tempus lectus ultricies sed. </p>
                        </div>
                        <!-- end of author section sidebar -->                           
                    </aside>
                    <!--End of side section-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of main section -->

@endsection
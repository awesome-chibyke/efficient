<?php
$active3 = 'active';
$title = 'Testimony | Grandour Empowerment Programme';
$description = 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.';
$keywords = 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos';
?>
@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section style="background-image: url(image/program-cover.png); background-repeat: no-repeat; background-size: cover; background-position: center;" class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Testimonies</h1>
                </div>
            </div>

            <div class="shape2"><img src="{{asset('main/assets/img/shape/shape2.png')}}" alt="image"></div>
            <div class="shape3"><img src="{{asset('main/assets/img/shape/shape3.png')}}" alt="image"></div>
            <div class="shape5"><img src="{{asset('main/assets/img/shape/shape5.png')}}" alt="image"></div>
            <div class="shape6"><img src="{{asset('main/assets/img/shape/shape6.png')}}" alt="image"></div>
            <div class="shape7"><img src="{{asset('main/assets/img/shape/shape7.png')}}" alt="image"></div>
            <div class="shape8"><img src="{{asset('main/assets/img/shape/shape8.png')}}" alt="image"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section style="background-image: url(image/program.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->

        <!-- Start Portfolio Area -->
        <section class="portfolio-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Peoples Testimonies</span>
                    <h2>Checkout what our happy clients are saying</h2>
                    <p>You too can be part of this great investment benefit by joining us today. Your just a click away to becoming a member.</p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    @if(count($videoTestimonies) > 0)
                        @foreach($videoTestimonies as $k => $eachTestimony)
                            @php $galleryMedia = new \App\Models\GalleryMedia(); @endphp
                    <div class="col-lg-4">
                        <div class="single-portfolio-item">
                        <a href="testimony" class="image d-block">
                            <iframe width="100%" height="300" src="{{$galleryMedia->buildEmbededLink($eachTestimony->video_link) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </a>

                        <div class="content">
                            <h3><a href="testimony">{{$eachTestimony->user_unique_id === '' ? $eachTestimony->full_name : $eachTestimony->userDetails->name }}</a></h3>
                        </div>
                    </div>
                    </div>
                        @endforeach
                            <div class="col-lg-12">
                            {{ $videoTestimonies->links() }}
                            </div>
                    @else
                        <div class="col-lg-12 text-center">
                            <p class="alert alert-info">No Available Data</p>
                        </div>
                    @endif

                </div>

            </div>
        </section>
        <!-- End Portfolio Area -->

        <!-- Start Feedback Area -->
        @if(count($textTestimonies) > 0)
            <section class="feedback-area ptb-100">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="feedback-image">
                                <img src="{{asset('main/assets/img/feedback-img1.jpg')}}" alt="image">
                                <img src="{{asset('main/image/avatar.png')}}" alt="image">
                                <img src="{{asset('main/image/avatar.png')}}" alt="image">
                                <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="feedback-content">
                                <span class="sub-title">Feedback</span>
                                <h2>What Our Clients Are Saying?</h2>

                                <div class="feedback-slides owl-carousel owl-theme">

                                    @foreach($textTestimonies as $k => $eachTestimony)
                                        <div class="single-feedback-item">
                                            <p>{{$eachTestimony->testimony}}</p>

                                            <div class="client-info">
                                                <div class="d-flex align-items-center">
                                                    @if($eachTestimony->user_unique_id !== '')

                                                        <img src="{{asset('storage/img/users/'.$eachTestimony->userDetails->profile_image)}}" alt="image">
                                                    @endif
                                                    <div class="title">
                                                        <h3>{{$eachTestimony->user_unique_id === '' ? $eachTestimony->full_name : $eachTestimony->userDetails->name }}</h3>
                                                        {{--<span>Carpenter</span>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shape16"><img src="{{asset('main/assets/img/shape/shape16.png')}}" alt="image"></div>
            </section>
            <!-- End Feedback Area -->
        @endif

@include('fincludes.footer')

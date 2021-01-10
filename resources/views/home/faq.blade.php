<?php
$active10 = 'active';
$title = 'FAQs | Grandour Empowerment Programme';
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
                    <h1>FAQs</h1>
                </div>
            </div>

            <div class="shape1"><img src="{{asset('main/assets/img/shape/shape1.png')}}" alt="image"></div>
            <div class="shape2"><img src="{{asset('main/assets/img/shape/shape2.png')}}" alt="image"></div>
            <div class="shape3"><img src="{{asset('main/assets/img/shape/shape3.png')}}" alt="image"></div>
            <div class="shape4"><img src="{{asset('main/assets/img/shape/shape4.png')}}" alt="image"></div>
            <div class="shape5"><img src="{{asset('main/assets/img/shape/shape5.png')}}" alt="image"></div>
            <div class="shape6"><img src="{{asset('main/assets/img/shape/shape6.png')}}" alt="image"></div>
            <div class="shape7"><img src="{{asset('main/assets/img/shape/shape7.png')}}" alt="image"></div>
            <div class="shape8"><img src="{{asset('main/assets/img/shape/shape8.png')}}" alt="image"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section style="background-image: url({{asset('main/image/program.png')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->


        <!-- Start FAQ Area -->
        <section class="faq-area pt-100 pb-70">
            <div class="container">
                <div class="row">

                    @if(count($faqs) > 0)
                        @foreach($faqs as $k => $eachFaq)
                            <div class="col-lg-6 col-md-6">
                                <div class="faq-item">
                                    <h3>Q: {{$eachFaq->question}}?</h3>
                                    <p><strong>A:</strong> {{$eachFaq->answer}}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12 text-center">
                            <p class="alert alert-danger">No Data Available</p>
                        </div>
                    @endif


                </div>
            </div>
        </section>
        <!-- End FAQ Area -->


@include('fincludes.footer')

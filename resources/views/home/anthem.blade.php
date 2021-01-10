<?php
$active1 = 'active';
$title = 'Our Anthem | Grandour Empowerment Programme';
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
                    <h1>Our Anthem</h1>
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
        </section style="background-image: url({{asset('main/image/program.png')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->

        <!-- Start About Area -->
        <section class="about-area pb-100 pt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content">
                            <div class="text">
                                <span class="sub-title">Our Anthem</span>
                                <h2>GRANDOUR ANTHEM</h2>
                                <p>GRANDOUR BUSINESS EMPIRE A BLESSING OF OUR TIME MAKING THE RICH RICHER LIFTING UP THE POOR EMPOWERING THE POWERLESS STANDING IN THE GAP</p>
                                <p>MY GRANDOUR! IS YOUR GRANDOUR!! AND OUR GRANDOUR!!!</p>
                                <p>WITH YOUR GENEROUSITY WE SMILE TO THE BANK AND WITH YOUR KIND GESTURE THERE’S FOOD ON OUR TABLES MAY GOD BLESS OUR GRANDOUR BLESS THE LEADERS TOO</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="about-img">
                            <img src="{{asset('main/image/about-us.png')}}" alt="image">
                        </div>
                    </div>


                </div>
            </div>

            <div class="shape15"><img src="{{asset('main/assets/img/shape/shape15.png')}}" alt="image"></div>
        </section>
        <!-- End About Area -->

@include('fincludes.footer')

<?php
$active1 = 'active';
$title = 'About | Grandour Empowerment Programme';
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
                    <h1>About Us</h1>
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
                                <h2>About Grandour Business Empire</h2>
                                <p>Grandour Business Empire is a duely registered business entity with the cooperate affairs commission of the Federal Republic for Network Marketing and General Merchandise.</p>
                                <p>It uniquely designed to accommodate everyone interested in making money and does not compulsorily t=require referrals like the conventional MLM Companies.</p>
                                <p>At Grandour, you make money, save money, acquire economic skills. and own your business.</p>
                                {{--<h2>About Us</h2>
                                <p>This is Grandour Business Empire. Grandour is a legally registered company with CAC. Grandour is registered as a network marketing company /general merchandise. </p><p>Grandour is a unique network marketing business which tries to accommodate every Nigerians into our empowerment program. (Both those who do not know how to refer).
                                </p>--}}

                            </div>
                            <div class="text">
                                <h2></h2>
                                <span class="sub-title pt-5">Our Vision</span>
                                {{--<p>It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                {{--<p> It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                <p>Our Vision is to be the last bus stop to all those struggling in the cesspol of life as well as those who are aspiring to increase their income generation to meet up with the ever increasing economic demand.</p>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="about-img">
                            <img src="{{asset('main/image/about-us.png')}}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="row  align-items-center" style="margin-top:20px;">
                            <div class="col-sm-6 col-xs-12">
                                <div class="text">
                                    <h2></h2>
                                    <span class="sub-title pt-5" style="color:var(--mainColor); font-weight: 700;">Capacity Building</span>
                                    {{--<p>It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                    {{--<p> It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                    <p class="">We are also committed to capacity building of the Grandourians through various carefully planned programmes.</p>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xs-12">
                                <div class="text">
                                    <h2></h2>
                                    <span class="sub-title pt-5" style="color:var(--mainColor); font-weight: 700;">Skill Acquisition</span>
                                    {{--<p>It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                    {{--<p> It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                    <p>Our Skills acquisitions program is loaded with what it takes to break even economically. These economic skills would help generate additional income for anyone who subscribes to it.</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


            <div class="shape15"><img src="{{asset('main/assets/img/shape/shape15.png')}}" alt="image"></div>
        </section>
        <!-- End About Area -->

@include('fincludes.footer')

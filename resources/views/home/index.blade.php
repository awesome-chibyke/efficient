<?php
$active = 'active';
$title = 'Grandour Empowerment Programme Raising Money and Capacity building for the people';
$description = 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.';
$keywords = 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos';
?>
@include('fincludes.head')

    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Main Banner Area -->
        <section class="home-wrapper-area">
            <div class="container-fluid">
                <div class="home-slides owl-carousel owl-theme">

                    <div class="single-banner-item">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="banner-content">
                                    <span class="sub-title pt-5"></span>
                                    <h1>GRANDOUR BUSINESS EMPIRE</h1>
                                    <p>Our program is for all and we are ready to serve you. A better world is our concern where all is happy and empowered.</p>
                                    <div class="btn-box">
                                        <div class="d-flex align-items-center">
                                            <a href="register" class="default-btn">Get Started</a>
                                            <a href="https://www.youtube.com/watch?v=yRr0_gJ-3mI" class="video-btn popup-youtube"><i class="flaticon-play-button"></i> Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 pt-5">
                                <div class="banner-image">
                                    <img src="{{asset('main/image/seminar.jpeg')}}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-banner-item">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12 ">
                                <div class="banner-content">
                                    <span class="sub-title pt-5"></span>
                                    {{--<h1>Grandour Empowerment Programme, Wealth and Capacity building</h1>
                                    <p>We are committed in ensuring that every nigerian citizen is financially stable and is living a better life.</p>--}}
                                    <h1>Grandour Empowerment Programme: </h1>
                                    <p>Wealth Creation * Financial Freedom * Business Ownership * Capacity Building</p>
                                    <div class="btn-box">
                                        <div class="d-flex align-items-center">
                                            <a href="register" class="default-btn">Get Started</a>
                                            <a href="https://www.youtube.com/watch?v=yRr0_gJ-3mI" class="video-btn popup-youtube"><i class="flaticon-play-button"></i> Watch Video</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="banner-image">
                                    <img src="{{asset('main/image/program.png')}}" alt="image">
                                </div>
                            </div>

                        </div>
                    </div>


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
            <div class="shape13"><img src="{{asset('main/assets/img/shape/shape13.png')}}" alt="image"></div>
            <div class="shape14"><img src="{{asset('main/assets/img/shape/shape14.png')}}" alt="image"></div>
        </section>
        <!-- End Main Banner Area -->

        <!-- Start Boxes Area -->
        <section class="boxes-area pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-boxes-box">
                            <div class="icon">
                                <i class="flaticon-research"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                </div>
                            </div>
                            <h3><a href="register">Financial Freedom</a></h3>
                            <p>Our program is designed to help the general public in securing a financial and stable life style.</p>
                            <a href="register" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Join Us <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-boxes-box">
                            <div class="icon">
                                <i class="flaticon-speed"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                </div>
                            </div>
                            <h3><a href="register">Capacity Building</a></h3>
                            <p>We are also committed in capacity building of the citizen through various programs we are conducting.</p>
                            <a href="register" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Join Us <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                        <div class="single-boxes-box">
                            <div class="icon">
                                <i class="flaticon-web-settings"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                </div>
                            </div>
                            <h3><a href="register">Skill Acquisition</a></h3>
                            <p>Our Skill Acquisition Programme is loaded with what it takes to break even economically. These economic Skills would help to generate additional income for anyone who subscribes to it.</p>
                            <a href="register" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Join Us <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Boxes Area -->

        <!-- Start About Area -->
        <section class="about-area pb-100">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-img">
                            <img src="{{asset('main/image/about-us.png')}}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="about-content">
                            <div class="text">
                                <span class="sub-title">About Grandour Business Empire</span>
                                {{--<h2>Grandour runs a contributive collaboration model of Empowerment.</h2>
                                <p>This is Grandour Business Empire. Grandour is a legally registered company with CAC. Grandour is registered as a network marketing company /general merchandise. </p><p>Grandour is a unique network marketing business which tries to accommodate every Nigerians into our empowerment program. (Both those who do not know how to refer).
                                </p>
                                <p> It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthrophy.</p>--}}
                                <p>Grandour Business Empire is a duely registered business entity with the cooperate affairs commission of the Federal Republic for Network Marketing and General Merchandise.</p>
                                <p>It is uniquely designed to accommodate everyone interested in making money and does not compulsorily require referrals like the conventional MLM Companies.</p>
                                <p>At Grandour, you make money, save money, acquire economic skills, invest and also own your business.</p>
                                <ul class="funfacts-list">
                                    <li>
                                        <div class="list">
                                            {{--'settings'=>$Settings, 'collectionCenters'=>$CollectionCenters, 'allMembers'=>$AllMembers--}}
                                            <i class="flaticon-menu-1"></i>
                                            <h3 class="odometer" data-count="{{$settings->total_projects}}">00</h3>
                                            <p>Total projects</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list">
                                            <i class="flaticon-web-settings"></i>
                                            <h3 class="odometer" data-count="{{$collectionCenters->count()}}">00</h3>
                                            <p>Total Center</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list">
                                            <i class="flaticon-conversation"></i>
                                            <h3 class="odometer" data-count="{{$allMembers->count()}}">00</h3>
                                            <p>Total members</p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="about" class="default-btn">More About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shape15"><img src="{{asset('main/assets/img/shape/shape15.png')}}" alt="image"></div>
        </section>
        <!-- End About Area -->

        <!-- Start Services Area -->
        <section class="services-area bg-f9f9f9 pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Services</span>
                    <h2>How It Works</h2>
                    {{--<p>YOUR MEMBERSHIP TO GRANDOUR BUSINESS EMPIRE IS GUARANTEED BY A SIGN UP fee of 32,500 and 1000 NAIRA PER SLOT FOR REGISTRATION.</p>--}}
                    <p>Grandour runs a contributive collaboration model of Empowerment. Its truely a paradigm shift in philanthropy. We made it a programme of Grandourians by Grandourians for Grandourians.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services-box">
                            <div class="icon">
                                <i class="flaticon-megaphone"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                    <div class="circle-two"></div>
                                </div>
                            </div>
                            <h3><a href="{{route('how-it-works')}}">Register/Fund Wallet </a></h3>
                            <p>Create an account with us.</p>
                            <p>Grandour Online Account comes with a wallet, go ahead and fund your wallet. Wallet can be funnded via Bank Transfer or Payment Processing Gateway</p>
                            <a href="{{route('how-it-works')}}" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Learn More <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services-box">
                            <div class="icon">
                                <i class="flaticon-keywords"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                    <div class="circle-two"></div>
                                </div>
                            </div>
                            <h3><a href="how-it-works">Invest</a></h3>
                            <p>Go through our invesment packages to see what it entails and what you sttand to gain from each.</p>
                            <p>From your dashboard, click Create Investment Button to get to investment page. Choose preferred investment and submit</p>
                            <p>The equivalent charge plus #1000 will be deducted from your grandour wallet.</p>
                            <p>Each investment have a life span of 90days, This Duration will be cut down by 3days for any referral you bring for a particular investment</p>
                            <a href="{{route('how-it-works')}}" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Learn More <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services-box">
                            <div class="icon">
                                <i class="flaticon-content-management"></i>
                                <div class="circles-box">
                                    <div class="circle-one"></div>
                                    <div class="circle-two"></div>
                                </div>
                            </div>
                            <h3><a href="{{route('how-it-works')}}">Take Home Incentives</a></h3>
                            <p>Grand soya oil or Slive soya oil with a carton of indomie noodles or semovita or any alternative offer.</p>
                            <p>Then wait for 90 days (or Less depending on the number of people you referred with the investment referral ID) and get empowered.</p>
                            <a href="{{route('how-it-works')}}" class="learn-more-btn"><i class="left-icon flaticon-next-button"></i> Learn More <i class="right-icon flaticon-next-button"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-12"><center><a class="learn-more-btn" href="{{route('how-it-works')}}"><i class="left-icon flaticon-next-button"></i> Find out more on "HOW DOES IT WORK?"</a></center></div>

                </div>
            </div>
        </section>
        <!-- End Services Area -->

        <!-- Start What We Do Area -->
        <section class="what-we-do-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="what-we-do-content">
                            <span class="sub-title">What We Do</span>
                            <h4>GRANDOUR EMPOWERMENT GENERAL OVERVIEW OF WHAT THE COMPANY OFFER AND WHAT YOU STAND TO BENEFIT</h4>
                            <p>Grandour Business Empire started its operation since September 6th 2018 when Grandour simple network marketing platform was introduced and many that understood and followed the process benefited from it and it has continued to sell without any hitch. Grandour has 2 different platforms with different features.</p>
                            <div class="skills-item">
                                <div class="skills-header">
                                    <h4 class="skills-title">GRANDOUR SIMPLE  NETWORK MARKETING  PLATFORM THAT IS SELLING VERY WELL</h4>
                                    <div class="skills-percentage">
                                        <div class="count-box mt-4">95%</div>
                                    </div>
                                </div>
                                <div class="skills-bar">
                                    <div class="bar-inner"><div class="bar progress-line" data-width="95"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="what-we-do-content-accordion">
                            <ul class="accordion">
                                <li class="accordion-item"><!--active-->
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class="flaticon-plus"></i>
                                        GRANDOUR BUSINESS EMPIRE IS INTRODUCING 90 DAYS EMPOWERMENT PROGRAMME WHICH COMMENCED 5TH OF JANUARY 2020
                                    </a>
                                    <!--show-->
                                    <div class="accordion-content">
                                        <p>*(NOTE👉YOUR 90 DAYS START COUNTING ONCE YOUR 32,500 IS  PAID WHICH IS YOUR  EMPOWERMENT ACTIVATION. ALSO YOU ARE EXPECTED TO PAY #1000 FOR YOUR FORM REGISTRATION. IF YOU ARE DOING MULTIPLE ACCOUNTS YOU WILL ALSO PAY FOR THE FORM SEPARATELY.</p>
                                        <p>YOU ARE ENTITLED TO A CARTON OF GRANDOUR SOYA COOKING OIL (2.75 LITRES  BY 6 BOTTLES) THIS WILL BE GIVEN TO YOU ALONGSIDE ANY OTHER ITEM YOU SELECT; 5KG SEMO OR A CARTON OF INDOMITABLE NOODLES.</p>
                                        <p>REFERRAL IS NOT COMPULSORY BUT WHEN YOU DO IT REDUCES YOUR DAY WITH 3 DAYS EACH.</p>
                                    </div>
                                </li>

                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class="flaticon-plus"></i>
                                        WHAT DO I GAIN WHEN I REFER PEOPLE?
                                    </a>
    
                                    <div class="accordion-content">
                                        <p>EACH PERSON YOU INTRODUCE TO GRANDOUR BUSINESS EMPOWERMENT PLATFORM  SHORTENS YOUR GRANT WAIT PERIOD BY 3 DAYS ASSUMING YOU INTRODUCE 5 PEOPLE IN A DAY, THEN THE SYSTEM WILL AUTOMATICALLY REDUCE YOUR WAITING DURATION DOWN TO 15 DAYS.</p>
                                        <p>HOWEVER, THE MORE YOU INTRODUCE PEOPLE, THE FASTER YOUR EMPOWERMENT DAY.<br>
                                            (Meaning your empowerment period will be shortened)<br>
                                            IF YOU WORK HARD YOU MIGHT GET EMPOWERED WITHIN 2 WEEKS OF REGISTRATION. (IT DEPENDS ON YOUR ABILITY TO REFER.</p>
                                        <p>IT IS A TRANSPARENT BUSINESS GET REGISTERED AND AT THE MATURITY DATE OF 90DAYS THAT IS 3 MONTHS WITHOUT REFERRING YOU WILL BE EMPOWERED</p>
                                    </div>
                                </li>

                                <li class="accordion-item">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class="flaticon-plus"></i>
                                        MULTIPLE ACCOUNTS IS ALSO ALLOWED
                                    </a>
    
                                    <div class="accordion-content">
                                        <p>YOU CAN HAVE MULTIPLE RUNNING ACCOUNT IN GRANDOUR EMPOWERMENT PROGRAM NOTE NO MORE RE-ENTRY  AND ONCE YOU ARE EMPOWERED  YOUR CONTRACT ENDS WITH THEM. IF YOU WISH TO CONTINUE YOU ENROLL AGAIN AFRESH AND GET YOUR REGISTRATION PACK ALSO.</p>
                                        <p>
                                            <ol>
                                            <li>ACCOUNT #32,500 IN 90DAYS    YOU EARN #67,500 TO YOUR BANK ACCOUNT</li>
                                            <li>ACCOUNTS #65,000 IN 90DAYS YOU WILL BE CREDITED #135,000K TO YOUR BANK ACCOUNT</li>
                                            <li>ACCOUNTS #97,500 YOU WILL BE CREDITED WITH #202,500K TO BANK ACCOUNT</li>
                                            <li>ACCOUNTS #130,000 YOU WILL BE CREDITED WITH #270,000 TO YOUR BANK</li>
                                            <li>ACCOUNTS #162,500 YOU WILL BE CREDITED WITH #337,500 TO YOUR BANK ACCOUNT</li>
                                            </ol>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End What We Do Area -->

        <!-- Start Feedback Area -->
        @if(count($textTestimonies) > 0)
        <section class="feedback-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="feedback-image">
                            <img src="{{asset('main/image/logo.png')}}"  alt="image">

                            {{--@foreach($textTestimonies as $k => $eachTestimony)
                                @if($eachTestimony->user_unique_id !== '')
                                    <img src="{{asset('storage/img/users/'.$eachTestimony->userDetails->profile_image)}}" alt="image">
                                @endif
                            @endforeach
                            <img src="{{asset('main/image/logo.png')}}" alt="image">

                            <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            <img src="{{asset('main/image/avatar.png')}}" alt="image">
                            <img src="{{asset('main/image/logo.png')}}" alt="image">--}}
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

        <!-- Start Portfolio Area -->
        @if(count($videoTestimonies) > 0)
        <section class="portfolio-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Peoples Testimonies</span>
                    <h2>Checkout what our happy clients are saying</h2>
                    <p>You too can be part of this great investment benefit by joining us today. Your just a click away to becoming a member.</p>
                </div>
            </div>

            <div class="container-fluid">
                <div class="portfolio-slides owl-carousel owl-theme">
                    @foreach($videoTestimonies as $k => $eachTestimony)
                    <div class="single-portfolio-item">
                        <a href="testimony" class="image d-block">
                            @php $galleryMedia = new \App\Models\GalleryMedia(); @endphp
                            <iframe width="100%" height="300" src="{{$galleryMedia->buildEmbededLink($eachTestimony->video_link) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </a>

                        <div class="content">
                            <h3><a href="testimony">{{$eachTestimony->user_unique_id === '' ? $eachTestimony->full_name : $eachTestimony->userDetails->name }}</a></h3>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="col-lg-12"><center><a class="learn-more-btn" href="testimony"><i class="left-icon flaticon-next-button"></i> View more testimonies</a></center></div>
            </div>
        </section>
        @endif
        <!-- End Portfolio Area -->

        <!-- Start Pricing Area -->
        @if(count($Plans) > 0)
        <section class="pricing-area bg-f9f9f9 pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Pricing</span>
                    <h2>Our Flexible Pricing Plan</h2>
                    <p>Our packages are flexible and affordable. Join the community today and enjoy our numerous services and benefit.</p>
                </div>

                <div class="row">

                    @foreach($Plans as $k => $eachPlan)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-pricing-box">
                            <div class="pricing-header">
                                <div class="icon">
                                    <i class="flaticon-paper-plane"></i>
                                    <div class="circles-box">
                                        <div class="circle-one"></div>
                                    </div>
                                </div>
                                <h3>{{$eachPlan->investment_title}}</h3>
                            </div>
                            @php $user = new  \App\Models\User(); @endphp
                            <div class="pricing-features">
                                <ul>
                                    @php $rewardsDetails = $eachPlan->rewardsDetails @endphp
                                    @if(count($rewardsDetails) > 0)
                                        @foreach($rewardsDetails as $kk => $eachRewardDetails)

                                            @php
                                                if($eachRewardDetails->reward_type === 'cash'){

                                                    $rewardAmountDetails = $user->getAmountForView($eachRewardDetails->amount);
                                                    $reward = 'Earn ('.$rewardAmountDetails['data']['currency'].') '.number_format(round($rewardAmountDetails['data']['amount']), 2).' in '.round($eachPlan->duration_in_days).' Days';
                                                }else{
                                                    $reward = $eachRewardDetails->reward;
                                                }
                                            @endphp
                                            <li>{{$reward}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            @php $minAmountDetails = $user->getAmountForView($eachPlan->min_investment_amount) @endphp
                            @php $maxAmountDetails = $eachPlan->max_investment_amount_switch === 'on' ? $user->getAmountForView($eachPlan->max_investment_amount) : 0 ; @endphp

                            <div class="price">
                                {{$minAmountDetails['data']['currency']}} {{number_format(round($minAmountDetails['data']['amount']), 2)}} {{$eachPlan->max_investment_amount_switch === 'on' ? ' - '.number_format(round($maxAmountDetails['data']['amount']), 2) : '' }}
                                <span>{{round($eachPlan->duration_in_days)}} days</span>
                            </div>

                            <a href="{{route('create_investment_interface')}}" class="default-btn">Book Now</a>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-lg-12"><center><a class="learn-more-btn" href="{{route('packages')}}"><i class="left-icon flaticon-next-button"></i> View all packages</a></center></div>

                </div>
            </div>
        </section>
        @endif
        <!-- End Pricing Area -->

        @if(count($News) > 0)
        <!-- Start Blog Area -->
        <section class="blog-area bg-f9f9f9 pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">Our New/Events</span>
                    <h2>Our Latest Media</h2>
                    <p>Get up to date information of the happening around Grandour communities.</p>
                </div>

                <div class="row">
                    @foreach($News as $singleNews)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post">
                            <div class="image">
                                <a href="{{route('news-details', [$singleNews->unique_id])}}" class="d-block">
                                    <img src="{{asset('storage/img/news_image/'.$singleNews->image_name)}}" alt="image">
                                </a>
                            </div>

                            <div class="content">
                                <h3><a href="{{route('news-details', [$singleNews->unique_id])}}">{{ucwords($singleNews->title)}}</a></h3>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('storage/img/news_image/'.$singleNews->image_name)}}" alt="image">
                                    <div class="info">
                                        {{--<h5>David Smith</h5>--}}
                                        <span>{{$singleNews->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-lg-12"><center><a class="learn-more-btn" href="news-events"><i class="left-icon flaticon-next-button"></i> View more News/Events</a></center></div>

                </div>
            </div>
        </section>
        @endif

        <!-- End Blog Area -->

        <!-- Start Partner Area -->
        <section class="partner-area " style="padding-bottom: 20px;">
            <div class="container">

                <div class="section-title">
                    <span class="sub-title">Partners</span>
                    <h2>Our Partners</h2>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-4 col-6 col-sm-4 col-md-4"></div>
                    <div class="col-lg-2 col-6 col-sm-4 col-md-4">
                        <div class="single-partner-item">
                            <img src="{{asset('main/image/grand-oil.png')}}" alt="grand-oil">
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 col-sm-4 col-md-4">
                        <div class="single-partner-item">
                            <img src="{{asset('main/image/Indomie.png')}}" alt="Indomie">
                        </div>
                    </div>

                </div>
                <div class="col-lg-12"><center><a class="learn-more-btn" href="collection-centers"><i class="left-icon flaticon-next-button"></i> Find out about collection centers close to you.</a></center></div>
            </div>
        </section>
        <!-- End Partner Area -->

@include('fincludes.footer')
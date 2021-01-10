<?php
$active9 = 'active';
$title = 'Packages | Grandour Empowerment Programme';
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
                    <h1>Pricing Packages</h1>
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

            {{--<div class="shape2"><img src="assets/img/shape/shape2.png" alt="image"></div>
            <div class="shape3"><img src="assets/img/shape/shape3.png" alt="image"></div>
            <div class="shape5"><img src="assets/img/shape/shape5.png" alt="image"></div>
            <div class="shape6"><img src="assets/img/shape/shape6.png" alt="image"></div>
            <div class="shape7"><img src="assets/img/shape/shape7.png" alt="image"></div>
            <div class="shape8"><img src="assets/img/shape/shape8.png" alt="image"></div>--}}
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section style="background-image: url({{asset('main/image/program.png')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->


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
                                                            $reward = 'Earn ('.$rewardAmountDetails['data']['currency'].') '.number_format($rewardAmountDetails['data']['amount'], 2).' in '.round($eachPlan->duration_in_days).' Days';
                                                        }else{
                                                            $reward = $eachRewardDetails->reward;
                                                        }
                                                    @endphp
                                                    <li>{{$reward}}</li>
                                                @endforeach
                                                    <li> Number of Days Deduction for Each Successful Referral: {{$eachPlan->no_of_days_for_ref}} Days</li>
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

                        <div class="col-lg-12"><center><a class="learn-more-btn" href="packages"><i class="left-icon flaticon-next-button"></i> View all packages</a></center></div>

                    </div>
                </div>
            </section>
        @endif
        <!-- End Pricing Area -->

@include('fincludes.footer')
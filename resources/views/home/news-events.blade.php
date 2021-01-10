<?php
$active5 = 'active';
$title = 'News/Events | Grandour Empowerment Programme';
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
                    <h1>News/Events</h1>
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
        </section style="background-image: url(image/program.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->


        <!-- Start Blog Area -->
        <section class="blog-area bg-f9f9f9 ptb-100">
            <div class="container-fluid">
                <div class="row">
                    @if(count($News) > 0)
                        @foreach($News as $singleNews)
                            <div class="col-lg-3 col-md-6">

                                <div class="single-blog-post">
                                    <div class="image">
                                        @php $userModel = new \App\Models\User(); @endphp
                                        @php $link = $userModel->returnLink(); @endphp
                                        <a href="{{route('news-details', [$singleNews->unique_id])}}" class="d-block">
                                            <img src="{{asset($link.'news_image/'.$singleNews->image_name)}}" alt="image">
                                        </a>
                                    </div>

                                    <div class="content">
                                        <h3><a href="{{route('news-details', [$singleNews->unique_id])}}">{{ucwords($singleNews->title)}}</a></h3>
                                        <div class="d-flex align-items-center">
                                            {{--<img src="{{asset('main/assets/img/user1.jpg')}}" alt="image">--}}
                                            <div class="info">
                                                {{--<h5>David Smith</h5>--}}
                                                <span>{{$singleNews->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                            <div class="col-lg-12 col-md-12">
                                {{$News->links()}}
                                {{--<div class="pagination-area text-center">
                                    <a href="#" class="prev page-numbers"><i class='bx bx-chevrons-left'></i></a>
                                    <span class="page-numbers current" aria-current="page">1</span>
                                    <a href="#" class="page-numbers">2</a>
                                    <a href="#" class="page-numbers">3</a>
                                    <a href="#" class="page-numbers">4</a>
                                    <a href="#" class="next page-numbers"><i class='bx bx-chevrons-right'></i></a>
                                </div>--}}
                            </div>
                    @else
                        <div class="col-lg-12 col-md-12 text-center">
                            <p class="col-sm-12">No Data Available</p>
                        </div>
                    @endif





                </div>
            </div>
        </section>
        <!-- End Blog Area -->




@include('fincludes.footer')

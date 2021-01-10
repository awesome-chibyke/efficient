<?php
$active5 = 'active';
$title = 'News/Events Detail | Grandour Empowerment Programme';
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
                    <h1>News/Events Detail</h1>
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
        </section style="background-image: url({{asset('main/image/program.png')}}; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->

        <!-- Start Blog Details Area -->
        <section class="blog-details-area bg-f9f9f9 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-details-desc">
                            <div class="article-image">
                                @php $userModel = new \App\Models\User(); @endphp
                                @php $link = $userModel->returnLink(); @endphp
                                <img src="{{asset($link.'news_image/'.$news->image_name)}}" alt="image">
                            </div>

                            <div class="article-content">
                                <div class="entry-meta">
                                    <ul>
                                        {{--<li>
                                            <i class='bx bx-folder-open'></i>
                                            <span>Category</span>
                                            <a href="#">Fashion</a>
                                        </li>
                                        <li>
                                            <i class='bx bx-group'></i>
                                            <span>View</span>
                                            813,454
                                        </li>--}}
                                        <li>
                                            <i class='bx bx-calendar'></i>
                                            <span>Last Updated</span>
                                            {{$news->created_at->diffForHumans()}}
                                        </li>
                                    </ul>
                                </div>

                                <h3>{{$news->title}}</h3>

                                <p>@php echo $news->news @endphp</p>

                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>--}}

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <aside class="widget-area">
                            {{--<section class="widget widget_search">
                                <h3 class="widget-title">Search</h3>

                                <form class="search-form">
                                    <label>
                                        <span class="screen-reader-text">Search for:</span>
                                        <input type="search" class="search-field" placeholder="Search...">
                                    </label>
                                    <button type="submit"><i class="bx bx-search-alt"></i></button>
                                </form>
                            </section>--}}

                            <section class="widget widget_dibiz_posts_thumb">
                                <h3 class="widget-title">Latest Posts</h3>

                                @if(count($latestPost) > 0)
                                    @foreach($latestPost as $eachPost)
                                        <article class="item">
                                            <a href="{{route('news-details', [$eachPost->unique_id])}}" class="thumb">
                                                <span class="fullimage cover bg1" role="img"></span>
                                            </a>
                                            <div class="info">
                                                <span>{{$eachPost->created_at->diffForHumans()}}</span>
                                                <h4 class="title usmall"><a href="#">{{$eachPost->title}}</a></h4>
                                            </div>

                                            <div class="clear"></div>
                                        </article>
                                    @endforeach
                                @endif

                            </section>

                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog Details Area -->
@include('fincludes.footer')

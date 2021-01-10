<?php
$active4 = 'active';
$title = 'Gallery | Grandour Empowerment Programme';
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
                    <h1>Gallery</h1>
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


        <!-- Start Gallery Area -->
        <section class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="row">

                    @if(count($gallery) > 0)
                        @php $userModel = new \App\Models\User(); @endphp
                        @php $link = $userModel->returnLink(); @endphp
                        @foreach($gallery as $k => $eachGallery)
                            @php $firstMedia = $eachGallery->galleryMedia[0]->media; @endphp
                            @php $image = asset($link.'gallery/'.$firstMedia); @endphp
                            <div class="col-lg-4 col-md-6 col-sm-6" style="position:relative;">
                                <div style="position: absolute; color:#080E32; text-shadow: 1px 1px 5px #fff; z-index: 200; bottom: 20px; text-decoration: underline; padding: 20px;">
                                    <h4>{{$eachGallery->title}}</h4>
                                </div>
                                <div class="single-gallery-item">
                                    <a data-fancybox="gallery" href="/single_gallery/{{$eachGallery->unique_id}}">
                                        <img src="{{$image}}" alt="image">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 col-md-12 col-sm-12" style="position:relative;">
                            {{$gallery->links()}}
                        </div>
                    @else
                        <div class="col-lg-12 col-md-12 col-sm-6 text-center">
                            <p class="alert alert-warning">No Data Available</p>
                        </div>
                    @endif

                    {{--<div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-gallery-item">
                            <a data-fancybox="gallery" href="{{asset('main/assets/img/blog/blog-img2.jpg')}}">
                                <img src="{{asset('main/assets/img/blog/blog-img2.jpg')}}'" alt="image">
                            </a>
                        </div>
                    </div>--}}


                </div>
            </div>
        </section>
        <!-- End Gallery Area -->

@include('fincludes.footer')

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
                    <h1>{{$gallery->title}}</h1>
                    <p style="color:white;">{{$gallery->description}}</p>
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
                    @php $galleryMedia = $gallery->galleryMedia; @endphp
                    @php $userModel = new \App\Models\User(); @endphp
                    @php $link = $userModel->returnLink(); @endphp
                    @if(count($galleryMedia) > 0)
                        @foreach($galleryMedia as $k => $eachGalleryMedia)
                            @if($eachGalleryMedia->media_type === 'image')
                            @php $image = asset($link.'gallery/'.$eachGalleryMedia->media); @endphp
                            <div class="col-lg-4 col-md-6 col-sm-6">

                                <div class="single-gallery-item">
                                    <a href="{{$image}}"  title="Click to view a larger size of the image" data-lightbox="roadtrip">
                                        <img src="{{$image}}" alt="image">
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($eachGalleryMedia->media_type === 'video')
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    {{--<div class="single-gallery-item">
                                        <a data-fancybox="gallery" href="{{asset('main/assets/img/blog/blog-img1.jpg')}}">
                                            <img src="{{$image}}" alt="image">
                                        </a>
                                    </div>--}}
                                    <iframe width="100%" height="" src="{{ $eachGalleryMedia->buildEmbededLink($eachGalleryMedia->media) }}" frameborder="0" allow="autoplay; encrypted-media"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                            @endif

                        @endforeach
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

@php $pageName = 'News' @endphp
@php $active = 'news' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">{{$news->title}}</h2>
                            </div>

                            <div class="col-sm-12">
                                @if(Session::has('success_message'))
                                    <p class="alert alert-success text-center"  role="alert">

                                        {{ Session::get('success_message') }}

                                    </p>
                                @elseif(Session::has('error_message'))
                                    <p class="alert alert-danger text-center text-white" role="alert">

                                        {{ Session::get('error_message') }}

                                    </p>
                                @endif
                            </div>

                            <div class="col-sm-12" style="padding: 10px;">
                                <div class="project-desc">
                                    <h5 class="card-title" style="color:white;">{{$news->title}}</h5>
                                    <div class="card-body d-flex align-items-center">
                                        {{--<img class="border-radius-50 flex-60-thumb mr-4" src="img/shop-img/19.jpg" alt="">--}}

                                        <div class="div">
                                            {{--<h5 class="mt-20"><a class="card-title" href="project-details.html">Redesign - Landing page</a></h5>
                                            <p class="mb-20">It will be as simple as Occidental</p>--}}
                                            <div class="avatar-area mb-15">
                                                @php $link = auth()->user()->returnLink(); @endphp
                                                <img src="{{asset($link.'news_image/'.$news->image_name)}}" style="width: 80%;">
                                                <div class="img-group" style="color:white;">
                                                    {{--<a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Smith Jones"><img src="img/member-img/2.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="David jhon"><img src="img/member-img/3.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jhon Henry"><img src="img/member-img/4.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Smith"><img src="img/member-img/5.png" alt="user" class="rounded-circle"></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="font-13 mb-20" style="color:white;">{{$news->created_at}}</h6>
                                    <div style="color:white !important; margin-top: 20px;">@php echo $news->news @endphp</div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
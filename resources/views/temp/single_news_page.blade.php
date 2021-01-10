@php $pageTitle = $news->title @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">{{$news->title}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$news->title}}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{--<div class="col-lg-5">
                                <img class="img-responsive" src="{{asset('black_theme/img/dashboard/withdrawal.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}}">
                            </div>--}}
                            <div class="col-lg-12">
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <i class="fa fa-envelope-o mr-2"></i>
                                        {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @elseif(Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        <i class="fa fa-envelope-o mr-2"></i>
                                        {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif

                            </div>

                            <div class="col-lg-12">
                                <div class="project-desc">
                                    <h5 class="card-title">{{$news->title}}</h5>
                                    <div class="card-body d-flex align-items-center">
                                        {{--<img class="border-radius-50 flex-60-thumb mr-4" src="img/shop-img/19.jpg" alt="">--}}

                                        <div class="div">
                                            {{--<h5 class="mt-20"><a class="card-title" href="project-details.html">Redesign - Landing page</a></h5>
                                            <p class="mb-20">It will be as simple as Occidental</p>--}}
                                            <div class="avatar-area mb-15">
                                                @php $link = auth()->user()->returnLink(); @endphp
                                                <img src="{{asset($link.'news_image/'.$news->image_name)}}" style="width: 80%;">
                                                <div class="img-group">
                                                    {{--<a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Smith Jones"><img src="img/member-img/2.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="David jhon"><img src="img/member-img/3.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jhon Henry"><img src="img/member-img/4.png" alt="user" class="rounded-circle"> </a>
                                                    <a class="user-avatar user-avatar-group" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Smith"><img src="img/member-img/5.png" alt="user" class="rounded-circle"></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="font-13 mb-20">{{$news->created_at}}</h6>
                                    <p>@php echo $news->news @endphp</p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
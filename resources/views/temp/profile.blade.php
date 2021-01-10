@php $pageTitle = 'View Profile' @endphp

@extends('layouts.design')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">View Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <i class="fa fa-envelope-o mr-2"></i>
                                        {{ Session::get('message') }}
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
                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="profile-thumb-contact text-center">
                                            <div class="profile--tumb" onclick="bringOutModalMain('.profile-pix-update')" title="Click To Change Profile Picture">
                                                @php $link = auth()->user()->returnLink(); @endphp
                                                <img src="{{asset(($user->profile_image === null) ? 'img/alt_image.png' : $link.'users/'.$user->profile_image)}}" alt="{{env('APP_NAME', 'LARAVEL')}}">
                                            </div>
                                            <h2 class="mt-50">{{($user->name === null)?'None':$user->name}}</h2>
                                            <h5>{{($user->type_of_user === null)?'None':$user->type_of_user}}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="card rounded box-margin mt-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Available Balance</h6>
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    @php $balanceDetails = $user->getAmountForView($user->balance) @endphp
                                                    <h1 class="mb-0">{{number_format(round($balanceDetails['data']['amount']), 2)}} ({{$user->getBalanceForView()['data']['currency']}})</h1>
                                                </div>
                                            </div>
                                            <img class="chat-img" src="{{asset('black_theme/img/dashboard/cash.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}">
                                        </div>
                                        <hr>
                                        <h6 class="card-title">Bank Name</h6>
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    <h3 class="mb-0">{{($user->bank  === null)?'None':$user->bank }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <style>
                                            .ribbon{
                                                background-color: transparent !important;
                                            }
                                            .ribbon-bookmark::before{
                                                display: none;
                                            }
                                        </style>
                                        <hr>
                                        <h6 class="card-title">Bank Account Name</h6>
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    <h3 class="mb-0">{{($user->account_name  === null)?'None':$user->account_name }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6 class="card-title">Bank Account Number</h6>
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    <h3 class="mb-0"> {{($user->account_number  === null)?'None':$user->account_number }}</h3>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-7 pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">Email</div>
                                            <h4 class="ribbon-content">{{($user->email  === null)?'None':$user->email }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">Phone Number</div>
                                            <h4 class="ribbon-content">{{($user->phone  === null)?'None':$user->phone }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">State / Region</div>
                                            <h4 class="ribbon-content">{{($user->state  === null)?'None':$user->state }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-danger">Gender</div>
                                            <h4 class="ribbon-content">{{($user->gender  === null)?'None':$user->gender }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-default">Date Of Birth</div>
                                            <h4 class="ribbon-content">{{($user->date_of_birth  === null)?'None':$user->date_of_birth }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">City</div>
                                            <h4 class="ribbon-content">{{($user->city  === null)?'None':$user->city }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">Country</div>
                                            <h4 class="ribbon-content">{{($user->country  === null)?'None':$user->country }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-danger">Address</div>
                                            <p class="ribbon-content">{{($user->address  === null)?'None':$user->address }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-danger">Preferred Center</div>
                                            @php

                                                if($user->centers === null){
                                                    $center = 'None';
                                                }else{
                                                $centers = $user->centers;
                                                $center = ucwords($centers->team).' - '.$centers->address.', '.$centers->city_town.', '. $centers->state_region_province.', '.$centers->country;
                                                }

                                            @endphp
                                            <p class="ribbon-content">{{$center}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->

@endsection
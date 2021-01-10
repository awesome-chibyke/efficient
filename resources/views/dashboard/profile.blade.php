@php $pageName = 'My PROFILE' @endphp
@php $active = 'profile' @endphp
@extends('layouts.man_dash')

@section('content')

<div class="author-area-pro">
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="author-widgets-single res-mg-t-30">
                    <div class="author-wiget-inner">
                        <input style="display:none;"  type="file" multiple class="form-control file_name" onchange="UploadPlofileImage()" id="file_name" />
                        <div class="perso-img" style="cursor:pointer;" onclick="promptProfileImageUpload()" title="Click To Change Profile Picture">
                            @php $link = auth()->user()->returnLink(); @endphp
                            <img src="{{asset(($user->profile_image === null) ? 'img/alt_image.png' : $link.'users/'.$user->profile_image)}}" alt="{{env('APP_NAME', 'LARAVEL')}}" class="img-circle circle-border m-b-md" style="max-width: 100px;" />
                        </div>
                        <div class="persoanl-widget-hd persoanl1-widget-hd">
                            <h2>
                                <h2 class="mt-50">{{($user->name === null)?'None':$user->name}}</h2>
                            </h2>
                            <p>
                                <h5 style="color: #fff;">{{($user->type_of_user === null)?'None':$user->type_of_user}}</h5>
                            </p>
                            <p>
                                <div class="err_profile_image error_displayer"></div>
                            </p>
                        </div>
                        {{--@php $balanceDetails = $user->getAmountForView($user->balance) @endphp--}}
                        @php $balanceDetails = auth()->user()->getUserBalanceForView(Request::segment(2) ?? auth()->user()->unique_id)//auth()->user()->getBalanceForView(Request::segment(2) ?? null) @endphp

                        <div class="social-widget-result social-widget1-result">
                            <span>Main Wallet Balance: ({{$balanceDetails['currency']}}) {{number_format(round($balanceDetails['main']), 2)}}</span> <br>
                            <span>Pending Withdrawal Balance: ({{$balanceDetails['currency']}}) {{number_format(round($balanceDetails['withdrawn']), 2)}}</span>
                            {{--<span>350 Following</span> |
                            <span>610 Followers</span>--}}
                        </div>
                    </div>
                    <div class="row">

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

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Email Address</h4>
                                        <p>{{$user->email}}</p>
                                        {{--<div class="text-right like-love-list">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Phone Number</h4>
                                        <p>{{$user->phone === null ? 'None':$user->phone}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Gender</h4>
                                        <p>{{$user->gender === null ? 'None':$user->gender}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Address</h4>
                                        <p>{{$user->address === null ? 'None':$user->address}}</p>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>City</h4>
                                        <p>{{$user->city === null ? 'None':$user->city}}</p>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>State/Region</h4>
                                        <p>{{$user->state === null ? 'None':$user->state}}</p>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Country</h4>
                                        <p>{{$user->country === null ? 'None':$user->country}}</p>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Bank</h4>
                                        <p>{{($user->bank  === null)?'None':$user->bank }}</p>

                                    </div>
                                </div><div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Account Name</h4>
                                        <p>{{($user->account_name  === null)?'None':$user->account_name }}</p>

                                    </div>
                                </div><div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Account Number</h4>
                                        <p>{{($user->account_number  === null)?'None':$user->account_number }}</p>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
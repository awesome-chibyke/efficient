@php $pageName = 'EDIT PROFILE' @endphp
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

                        @php $balanceDetails = $user->getUserBalanceForView($user->unique_id) @endphp
                        <div class="social-widget-result social-widget1-result">
                            <span>Main Wallet Balance: ({{$balanceDetails['currency']}}) {{number_format(round($balanceDetails['main']), 2)}}</span> <br>
                            <span>Pending Withdrawal Balance: ({{$balanceDetails['currency']}}) {{number_format(round($balanceDetails['withdrawn']), 2)}}</span>
                            {{--<span>350 Following</span> |
                            <span>610 Followers</span>--}}
                        </div>
                    </div>
                    <form method="post" action="{{ route('updateProfile') }}">
                        @csrf
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
                                        <h4>Full Name</h4>
                                        <div class="form-select-list">
                                            <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Default input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Gender</h4>
                                        <div class="form-select-list">
                                            <select name="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option {{$user->gender === 'male' ? 'selecetd':''}}  value="male">Male</option>
                                                <option {{$user->gender === 'female' ? 'selecetd':''}} value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Date of Birth</h4>
                                        <div class="form-select-list">
                                            <input name="date_of_birth" type="date" class="form-control" value="{{$user->date_of_birth}}" placeholder="Date of Birth">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Phone Number</h4>
                                        <div class="form-select-list">
                                            <input name="phone" type="text" class="form-control" value="{{$user->phone}}" placeholder="Phone Number">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Address</h4>
                                        <div class="form-select-list">
                                            <input name="address" type="text" class="form-control" value="{{$user->address}}" placeholder="Address">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>City</h4>
                                        <div class="form-select-list">
                                            <input name="city" type="text" class="form-control" value="{{$user->city}}" placeholder="City">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>State / Region</h4>
                                        <div class="form-select-list">
                                            <input name="state" type="text" class="form-control" value="{{$user->state}}" placeholder="State">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="widget-text-box">
                                        <h4>Country</h4>
                                        <input type="hidden" id="countryHolder" class="form-control" value="{{$user->country}}" />
                                        <div class="form-select-list">
                                            <select id="country" name="country" class="form-control">
                                                <option value="">Select Country</option>

                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Update Profile</button>
                                </div>

                            </div>
                        </div>

                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
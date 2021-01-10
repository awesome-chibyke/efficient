@php $pageTitle = 'Settings Page' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Settings Page</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Settings Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Change Password</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Change/Upload Profile Image</a>
                                    @if (Auth::user()->type_of_user === 'admin')
                                    {{--<a class="nav-link" id="v-pills-create-game-tab" data-toggle="pill" href="#v-pills-create-game" role="tab" aria-controls="v-pills-create-game" aria-selected="false">Main Site Settings</a>--}}
                                    @endif
                                    <a class="nav-link" id="v-pills-preferred_currency-tab" data-toggle="pill" href="#v-pills-preferred_currency" role="tab" aria-controls="v-pills-preferred_currency" aria-selected="false">Update Preferred Currency</a>
                                </div>
                            </div>
                            <div class="col-sm-8">
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
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form id="contactForm" method="POST" action="{{ route('updatePassword') }}" class="log-form">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="oldPassword" class="control-label">{{ __('Current Password') }}</label>
                                                        <input type="password" id="oldPassword" name="oldPassword" value="{{ old('oldPassword') }}" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="Current Password" required data-error="Current Password" autofocus>
                                                        <span toggle="#password-field" class="fa fa-lg fa-eye field-icon Password" onclick="togglePassword('oldPassword', 'Password')"></span>
                                                        @error('oldPassword')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="newPassword" class="control-label">{{ __('New Password') }}</label>
                                                        <input type="password" id="newPassword" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" required data-error="New Password" autofocus>
                                                        <span toggle="#password-field" class="fa fa-lg fa-eye field-icon Password" onclick="togglePassword('newPassword', 'NPassword')"></span>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cPassword" class="control-label">{{ __('Confirm Password') }}</label>
                                                        <input type="password" id="cPassword" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required data-error="Confirm Password" autofocus>
                                                        <span toggle="#password-field" class="fa fa-lg fa-eye field-icon Password"  onclick="togglePassword('cPassword', 'CPassword')"></span>
                                                        @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Change Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form id="contactForm" method="POST" action="{{ route('uploadUserImage') }}" class="log-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class=" form-group">
                                                        <label for="image">{{ __('Choose Image') }}</label>
                                                        <input type="file" id="image" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" required data-error="Your Profile Image" value="{{ old('profile_image') }}"  />
                                                        @error('profile_image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Upload Image</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="tab-pane fade" id="v-pills-create-game" role="tabpanel" aria-labelledby="v-pills-create-game-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form id="contactForm" method="POST" action="{{ route('app_settings_post', ['appSettingId'=>$appSettings->unique_id]) }}" class="log-form">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="site_name" class="control-label">{{ __('Name of Site') }}</label>
                                                        <input type="text" id="site_name" name="site_name" value="{{$appSettings->site_name}}"  class="form-control @error('site_name') is-invalid @enderror" placeholder="Site Name" required data-error="Site Name is required" />
                                                        @error('site_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address1" class="control-label">{{ __('Address 1') }}</label>
                                                        <input type="text" id="address1" name="address1" value="{{$appSettings->address1}}"  class="form-control @error('address1') is-invalid @enderror" placeholder="Address 1" required data-error="Address 1 is required" />
                                                        @error('address1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address2" class="control-label">{{ __('Address 2') }}</label>
                                                        <input type="text" id="address2" name="address2" value="{{$appSettings->address2}}" class="form-control @error('address2') is-invalid @enderror" placeholder="Address 2" required data-error="Address 2" />
                                                        @error('address2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email1" class="control-label">{{ __('Email 1') }}</label>
                                                        <input type="email" id="email1" name="email1"  value="{{$appSettings->email1}}" class="form-control @error('email1') is-invalid @enderror" placeholder="Email 1" required data-error="Email 1" />
                                                        @error('email1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Email 2') }}</label>
                                                        <input type="email" id="email2" name="email2" value="{{$appSettings->email2}}"  class="form-control @error('email2') is-invalid @enderror" placeholder="Email 2" required data-error="Email 2" />
                                                        @error('email2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email2" class="control-label">{{ __('Website Url') }}</label>
                                                        <input type="url" id="site_url" name="site_url" value="{{$appSettings->site_url}}"  class="form-control @error('site_url') is-invalid @enderror" placeholder="Website Url" required data-error="Website Url" />
                                                        @error('site_url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="tab-pane fade" id="v-pills-preferred_currency" role="tabpanel" aria-labelledby="v-pills-preferred_currency-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form id="contactForm" method="POST" action="{{ route('updateCurrency') }}" class="log-form">
                                                    @csrf
                                                    <div class=" form-group">
                                                        <label for="preferred_currency">{{ __('Preferred Currency') }}</label>
                                                        <select id="prefered_currency" name="prefered_currency" class="form-control @error('prefered_currency') is-invalid @enderror" required data-error="Preferred Currency">

                                                            <option selected value="">Select Preferred Currency</option>

                                                            @if(count($allCurrency) > 0)

                                                                @for ($u = 0; $u < count($allCurrency); $u++)

                                                                    @if ($allCurrency[$u]->country_name === null)
                                                                        {{--//country_name = 'UNKNOWN'--}}
                                                                        @continue;
                                                                    @endif
                                                                    {{--//checkIfInArray(second_currency.trim(), currencyArray)--}}
                                                                    @if(!in_array($allCurrency[$u]->second_currency, $currencyArray) || !in_array($allCurrency[$u]->country_abbr, $countryCodeArray))
                                                                        @continue;
                                                                    @endif
                                                                    @php $theSelectedCurrency = $UserDetails->prefered_currency == $allCurrency[$u]->unique_id ? 'selected':''; @endphp
                                                                    <option {{$theSelectedCurrency}} value="{{$allCurrency[$u]->unique_id}}"> {{$allCurrency[$u]->country_name}} ({{$allCurrency[$u]->second_currency}}) ({{$allCurrency[$u]->country_abbr}}) </option>
                                                                @endfor

                                                            @endif


                                                        </select>
                                                        @error('prefered_currency')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Update Preferred Currency</button>
                                                    </div>
                                                </form>
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

    </div>

@endsection
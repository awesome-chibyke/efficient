@php $pageName = 'Settings' @endphp
@php $active = 'settings' @endphp
@extends('layouts.man_dash')

@section('content')

<div class="author-area-pro">
    <div class="container-fluid">
        <div class="row">





            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="author-widgets-single res-mg-t-30">

                    <form method="post" action="{{ route('updatePassword') }}">
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
                                        <h3 style="color:white;">Reset Password</h3>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="widget-text-box">
                                            <h4>Old Password</h4>
                                            <div class="form-select-list">
                                                <input type="password" name="oldPassword" class="form-control" :value="{{old('oldPassword')}}" >
                                                @error('oldPassword')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="widget-text-box">
                                            <h4>New Password</h4>
                                            <div class="form-select-list">

                                                <input name="password" type="password" class="form-control" value="{{old('password')}}" />
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="widget-text-box">
                                            <h4>Confirm Password</h4>
                                            <div class="form-select-list">
                                                <input name="password_confirmation" type="password" class="form-control" value="{{old('password_confirmation')}}" >
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Change Password</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>

                    <form method="post" action="{{ route('updateCurrency') }}">
                        @csrf
                        <div class="row">

                            <div class="col-sm-12" style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-sm-6" style="color:white">
                                        <h3 style="color:white;">Preferred Currency</h3>
                                        {{--@php print_r($currencyArray) @endphp--}}
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="widget-text-box">
                                            <h4>Select Preferred Currency</h4>
                                            <div class="form-select-list">
                                                <select id="prefered_currency" name="preferred_currency" class="form-control @error('prefered_currency') is-invalid @enderror" required data-error="Preferred Currency">

                                                    <option selected value="">Select Preferred Currency</option>

                                                    @if(count($allCurrency) > 0)

                                                        @for ($u = 0; $u < count($allCurrency); $u++)

                                                            @if ($allCurrency[$u]->country_name === null)
                                                                {{--//country_name = 'UNKNOWN'--}}
                                                                @continue;
                                                            @endif

                                                            @php $theSelectedCurrency = $UserDetails->preferred_currency == $allCurrency[$u]->unique_id ? 'selected':''; @endphp
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
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Update Preferred Currency</button>
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
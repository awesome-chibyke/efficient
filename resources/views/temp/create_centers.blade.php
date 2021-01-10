
@php $pageTitle = 'Create Centers' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Create Centers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create Centers</li>
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
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('store_centers') }}" class="log-form">
                                    @csrf

                                    <div class="col-12 center_fields_holder" data-count-holder="1">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_">Team</label>
                                                    <input type="text" id="team" name="team" class="form-control" placeholder="Team"  />
                                                </div>
                                                @error('team')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone1">Phone 1</label>
                                                    <input type="text" id="phone1" name="phone1" class="form-control" placeholder="Phone 1"  />
                                                </div>
                                                @error('phone1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone1">Phone 2</label>
                                                    <input type="text" id="phone2" name="phone2" class="form-control" placeholder="Phone 2"  />
                                                </div>
                                                @error('phone2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_">Address</label>
                                                    <input type="text" id="address" name="address" class="form-control" placeholder="Address"  />
                                                </div>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="city_town">City</label>
                                                    <input type="text" id="city_town" name="city_town" class="form-control" placeholder="City"  />
                                                </div>
                                                @error('city_town')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_">State/Region/Province</label>
                                                    <input type="text" id="state_region_province" name="state_region_province" class="form-control" placeholder="State/Province/Region"  />
                                                </div>
                                                @error('state_region_province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="country">{{ __('Country') }}</label>
                                                    {{--   <input type="text" id="country" name="country" class="form-control @error('country') is-invalid @enderror" placeholder="Your Country" value="{{$userDetails->country}}"  />--}}
                                                    <select id="country" name="country" class="form-control @error('country') is-invalid @enderror" ></select>
                                                    @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div><!-- Col -->

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label for="bank_code" class="control-label">{{ __('Bank Name') }} </label>
                                                <select onchange="dropBankName(this)" id="bank_code" name="bank_code" class="bank_code form-control @error('bank_code') is-invalid @enderror" data-bank-code=""  >

                                                </select>
                                                    <input type="hidden" id="selected_bank">
                                                <input type="hidden" id="bank_name" name="bank_name" value="{{old('bank_name')}}" class="bank_name form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Account Name" data-error="Encryption Key is Required" />

                                                @error('bank_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label for="bank_account_no" class="control-label">{{ __('Bank Account Number') }} </label>
                                                <input type="text" id="bank_account_no" name="bank_account_no" value="{{old('bank_account_no')}}" class="form-control @error('bank_account_no') is-invalid @enderror" placeholder="Bank Account Number" data-error="Bank Account Number is Required" />
                                                <input type="hidden" name="bankUniqueId">

                                                @error('bank_account_no')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label for="account_name" class="control-label">{{ __('Bank Account Name') }} </label>
                                                <input type="text" id="account_name" name="account_name" value="{{old('account_name')}}" class="form-control @error('account_name') is-invalid @enderror" placeholder="Account Name" data-error="Account Name is Required" />

                                                @error('account_name')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class=" form-group">
                                                <label for="preferred_currency">{{ __('Preferred Currency') }}</label>
                                                <select id="preferred_currency" name="preferred_currency" class="form-control @error('prefered_currency') is-invalid @enderror" data-error="Preferred Currency">

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
                                                            @php $theSelectedCurrency = auth()->user()->prefered_currency == $allCurrency[$u]->unique_id ? 'selected':''; @endphp
                                                            <option {{$theSelectedCurrency}} value="{{$allCurrency[$u]->unique_id}}"> {{$allCurrency[$u]->country_name}} ({{$allCurrency[$u]->second_currency}}) ({{$allCurrency[$u]->country_abbr}}) </option>
                                                        @endfor

                                                    @endif


                                                </select>
                                                @error('preferred_currency')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn guoBtn btn-block">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
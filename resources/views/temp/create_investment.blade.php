@php $pageTitle = 'Create Investment' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Create Investment</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create Investment</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>'

        {{--<div class="row">
            <div class="col-lg-12 box-margin">
                <div class="card" style="background: #080E32;">
                    <div class="card-body">

                        @include('dashboard.plans')

                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row">

            <div class="col-lg-12 box-margin">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

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
                                <form id="contactForm" method="POST" action="{{ route('create_an_investment') }}" class="log-form">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="total_numbers_to_select">{{ __('Packages') }}</label>
                                                <select onchange="showInvestDetails(this)" name="investment_settings_unique_id" id="investment_settings_unique_id" class="form-control @error('investment_settings_unique_id') is-invalid @enderror">
                                                    <option value="">Select A Plan</option>
                                                    @if(count($investments) > 0)
                                                        @foreach($investments as $k => $eachInvestments)
                                                           @php $minAmountDetails = auth()->user()->getAmountForView($eachInvestments->min_investment_amount) @endphp
                                                            @php $maxAmount =  ' - '.$eachInvestments->max_investment_amount_switch === 'on' ? number_format(round(auth()->user()->getAmountForView($eachInvestments->max_investment_amount)['data']['amount'])) : '' @endphp
                                                    <option value="{{$eachInvestments->unique_id}}">{{ucwords($eachInvestments->investment_title)}} ({{$minAmountDetails['data']['currency']}} {{number_format(round($minAmountDetails['data']['amount']), 2)}}{{$maxAmount}})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('investment_settings_unique_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 hidden hiddenDiv">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Amount for Form Purchase') }} (<small style="color:#333;">{{'Not Edittable'}}</small>) (<small style="color:#333">You will make this payment at your Collection Center</small>)</label>
                                                <input type="text" id="amount_for_form" name="amount_for_form" class="form-control @error('amount_for_form') is-invalid @enderror" required data-error="Amount is required" readonly placeholder="Amount" value="{{ old('investment_title') }}"  />
                                                @error('amount_for_form')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 hidden hiddenDiv">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Minimum Amount for this plan') }} (<small style="color:#333;">{{'Not Edittable'}}</small>)</label>
                                                <input type="text" id="amount_" name="amount_" class="form-control @error('amount_') is-invalid @enderror" required data-error="Amount is required" readonly placeholder="Amount" value="{{ old('investment_title') }}"  />
                                                @error('amount_')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 hidden amount_2_holder">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Maximum Amount for this plan') }} (<small>{{'Not Edittable'}}</small>)</label>
                                                <input type="text" id="amount_2" name="amount_2" class="form-control @error('amount_2') is-invalid @enderror" data-error="Max Amount is required" readonly placeholder="Maximmum Amount" value="{{ old('amount_2') }}"  />
                                                @error('amount_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 hidden preferred_amount">
                                            <div class="form-group">
                                                <label for="preferred_amount">{{ __('Enter Preferred Amount') }} <small>{{'Amount must be equal or between the max and minimum amount for this plan/package'}}</small></label>
                                                <input type="text" id="preferred_amount" name="preferred_amount" class="form-control @error('preferred_amount') is-invalid @enderror" placeholder="Preferred Amount" value="{{ old('preferred_amount') }}"  />
                                                @error('preferred_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 hidden hiddenDiv">
                                            <div class="form-group">
                                                <label  for="duration">{{ __('Duration') }} (<small style="color:#333;">{{'Not Edittable'}}</small>)</label>
                                                <input readonly type="text" id="duration_in_days" name="time_remaining_in_days" class="form-control @error('duration') is-invalid @enderror" required placeholder="Duration" value="{{ old('duration') }}"  />
                                                @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--investment_title 	min_investment_amount 	max_investment_amount_switch 	max_investment_amount 	duration_in_days--}}
                                        <div class="col-sm-12" style="margin-top: 10px;">
                                            <div class="form-group">
                                                <label for="referral_id">{{ __('Referral Id') }} <small style="color:#333;">({{'Optional'}})</small></label>
                                                <input type="text" id="referral_id" name="referral_id" class="form-control @error('referral_id') is-invalid @enderror" placeholder="Referral ID" value="{{ $refId ?? old('referral_id') }}"  />
                                                @error('referral_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 hidden hiddenDiv list_of_rewards">

                                        </div>

                                    </div>
                                    <div class="form-group" style="margin-top: 20px;">
                                        <button type="submit" class="btn guoBtn">Submit</button>
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
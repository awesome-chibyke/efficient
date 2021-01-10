@php $pageName = 'Investments' @endphp
@php $active = 'investments' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Add Investment Package</h2>
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

                            <div class="col-sm-12" >
                                <div class="row">
                                    <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('create_investment_plan') }}" class="log-form">
                                        @csrf

                                        @php $amountdetails = auth()->user()->currency_details @endphp
                                        <div class="col-12 faqs_fields_holder" style="padding-left: 20px; padding-right: 20px;" data-count-holder="1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_">Title of Package</label>
                                                        <input value="{{old('name_of_plan')}}" type="text" id="name_of_plan" name="name_of_plan" class="form-control" placeholder="Title of Package"  />
                                                    </div>
                                                    @error('name_of_plan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        {{--{{old('amount')}}--}}
                                                        <label for="amount">Amount ({{$amountdetails->second_currency}})</label>
                                                        <input type="text" value="{{old('amount')}}" name="amount" class="form-control" placeholder="Amount"  />
                                                    </div>
                                                    @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_">Amount disbursed as reward after package duration for user with referral(s) ({{$amountdetails->second_currency}})</label>
                                                        <input value="{{old('amount_for_referral')}}" type="text" id="amount_for_referral" name="amount_for_referral" class="form-control"  />
                                                    </div>
                                                    @error('amount_for_referral')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_">Amount disbursed as reward after package duration for user without referral(s) ({{$amountdetails->second_currency}})</label>
                                                        <input value="{{old('amount_for_no_referral')}}" type="text" id="amount_for_no_referral" name="amount_for_no_referral" class="form-control"  />
                                                    </div>
                                                    @error('amount_for_no_referral')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="duration_for_referral_reward">Duration for Package (days)</label>
                                                        <input value="{{old('duration_for_referral_reward')}}" type="text" id="duration_for_referral_reward" name="duration_for_referral_reward" class="form-control"  />
                                                    </div>
                                                    @error('duration_for_referral_reward')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                {{--//unique_id 	name_of_plan 	amount 	amount_for_referral 	amount_for_no_referral 	duration_for_referral_reward 	number_to_be_referred 	form_fee 	no_of_days_before_reward_collection 	maximum_no_of_referral--}}
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="form_fee">Cost of Registration Form ({{$amountdetails->second_currency}})</label>
                                                        <input value="{{old('form_fee')}}" type="text" id="form_fee" name="form_fee" class="form-control"  />
                                                    </div>
                                                    @error('form_fee')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="no_of_days_before_reward_collection">Number of days before Reward Collection  (days)</label>
                                                        <input value="{{old('no_of_days_before_reward_collection')}}" type="text" id="no_of_days_before_reward_collection" name="no_of_days_before_reward_collection" class="form-control"  />
                                                    </div>
                                                    @error('no_of_days_before_reward_collection')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="maximum_no_of_referral">Maximum Number of Referrals for this Packages</label>
                                                        <input value="{{old('maximum_no_of_referral')}}" type="text" id="maximum_no_of_referral" name="maximum_no_of_referral" class="form-control"  />
                                                    </div>
                                                    @error('maximum_no_of_referral')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-12 reward_holder" reward_holder_count="1">
                                                    <div class="row">

                                                        <div class="col-lg-12 col-md-12">
                                                            <strong style="color:white">1)</strong>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="reward">{{ __('Reward') }}</label>
                                                                <input type="text" id="reward_type1" name="reward[]" class="form-control "  data-error="Description of Reward is required" placeholder="Description of Reward" value="{{ old('reward[]') }}"  />
                                                                @if($errors->has('reward.*'))
                                                                    <span class="invalid-feedback" role="alert">
                                                            @foreach($errors->get('reward.*') as $message)
                                                                            @foreach($message as $error)
                                                                                <strong>{{ $error }}</strong><br>
                                                                            @endforeach
                                                                        @endforeach
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div  class="col-sm-12 reward_field_adder" style="margin-bottom: 20px;">
                                                    <button onclick="addNewRewardField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12" style="padding-left: 10px; padding-right: 10px;">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
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
    </div>

@endsection
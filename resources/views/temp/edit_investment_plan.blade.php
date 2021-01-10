@php $pageTitle = 'Edit Investment Plan' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Edit An Investment Plan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit An Investment Plan</li>
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
                                <form id="contactForm" method="POST" action="{{ route('update_investment_plan', [$investmentPlan->unique_id]) }}" class="log-form">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Investment Title') }}</label>
                                                <input type="text" id="investment_title" name="investment_title" class="form-control @error('investment_title') is-invalid @enderror" required data-error="Title is required" placeholder="Investment Title" value="{{$investmentPlan->investment_title }}"  />
                                                @error('type_of_game')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                @php $formAmountDetails = auth()->user()->getAmountForView($investmentPlan->amount_for_form); @endphp
                                                @php $formAmount = round($formAmountDetails['data']['amount']); @endphp
                                                <label for="amount_for_form">{{ __('Amount for Form Purchase') }} ({{$formAmountDetails['data']['currency']}})</label>
                                                <input type="text" id="amount_for_form" name="amount_for_form" class="form-control @error('amount_for_form') is-invalid @enderror" required data-error="Amount for form purchase" placeholder="Amount for Form Purchase" value="{{$formAmount}}"  />
                                                @error('amount_for_form')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                @php $minAmountDetails = auth()->user()->getAmountForView($investmentPlan->min_investment_amount); @endphp
                                                @php $mainMinAmount = round($minAmountDetails['data']['amount']); @endphp
                                                <label for="total_numbers">{{ __('Minimum Amount For This Investment') }} ({{ $minAmountDetails['data']['currency'] }})</label>
                                                <input type="text" id="min_investment_amount" name="min_investment_amount" class="form-control @error('min_investment_amount') is-invalid @enderror" required data-error="Minimum Investment Amount is required" placeholder="Minimum Amount" value="{{round($mainMinAmount)}}"  />
                                                @error('min_investment_amount')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="no_of_days_for_ref">{{ __('Number of Days to Be Deducted on each Referral') }}</label>
                                                <input type="text" id="no_of_days_for_ref" name="no_of_days_for_ref" class="form-control @error('no_of_days_for_ref') is-invalid @enderror" required data-error="Number of Days to Be Deducted on each Referral is required" placeholder="Number of Days to Be Deducted on each Referral" value="{{$investmentPlan->no_of_days_for_ref}}"  />
                                                @error('no_of_days_for_ref')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="total_numbers_to_select">{{ __('Maximum Amount Display Option') }}</label>
                                                <select onchange="showMaxInvestAmount(this)" name="max_investment_amount_switch" id="max_investment_amount_switch" class="form-control @error('max_investment_amount_switch') is-invalid @enderror">
                                                    <option value="">Select Max Amount Option</option>
                                                    <option {{$investmentPlan->max_investment_amount_switch === 'on' ? 'selected':''}} value="on">Show Max Amount</option>
                                                    <option {{$investmentPlan->max_investment_amount_switch === 'off' ? 'selected':''}} value="off">Hide Max Amount</option>
                                                </select>
                                                @error('max_investment_amount_switch')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--investment_title 	min_investment_amount 	max_investment_amount_switch 	max_investment_amount 	duration_in_days--}}
                                        <div class="col-lg-12 col-md-12 {{$investmentPlan->max_investment_amount_switch === 'off' ? 'hidden':''}} max_investment_amount_holder">
                                            <div class="form-group">
                                                @php $maxAmountDetails = $investmentPlan->max_investment_amount_switch === 'on' ? auth()->user()->getAmountForView($investmentPlan->max_investment_amount) : ''; @endphp

                                                <label for="max_investment_amount">{{ __('Maximum Amount for this Investment') }} ({{ $minAmountDetails['data']['currency'] }}})</label>
                                                <input type="text" id="max_investment_amount" name="max_investment_amount" class="form-control @error('max_investment_amount') is-invalid @enderror" data-error="Maximum Amount for this investment is required" placeholder="Maximum Amount for this Investment" value="{{$investmentPlan->max_investment_amount_switch === 'on' ? $maxAmountDetails['data']['amount'] : ''}}"  />
                                                @error('max_investment_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="total_number_days_before_draw">{{ __('Duration of Investment (IN DAYS)') }}</label>
                                                <input type="text" id="duration_in_days" name="duration_in_days" class="form-control @error('duration_in_days') is-invalid @enderror" required data-error="Duration of investment" placeholder="Duration of Investment" value="{{ round($investmentPlan->duration_in_days) }}"  />
                                                @error('duration_in_days')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12">
                                            <hr style="width: 100%;">
                                            <h6>Specify the different Rewards/Prizes one will win/get under this particular investment. Tick the checkbox beside any of the reward to have deleted while updating this Investment Package</h6>
                                        </div>

                                        @php $investmentRewards = $investmentPlan->rewardsDetails; @endphp
                                        @if(count($investmentRewards) > 0)
                                            @foreach($investmentRewards as $k => $eachInvestmentReward)
                                                <div class="col-sm-12 reward_holder" reward_holder_count="{{$k+1}}">
                                                    <div class="row">

                                                        <div class="col-lg-12 col-md-12">
                                                            <strong>{{$k+1}}) </strong><span><input type="checkbox" name="delete_reward[]" value="{{$eachInvestmentReward->unique_id}}" /> </span>
                                                        </div>

                                                        <div class="col-sm-12 reward_type_case">
                                                            <div class="form-group">

                                                                <input type="hidden" name="reward_unique_id[]" class="form-control" value="{{$eachInvestmentReward->unique_id}}"  />

                                                                <label for="reward_type">{{ __('Nature of Reward') }}</label>
                                                                <select onchange="shuffleAmountField(this)" name="reward_type[]" class="form-control reward_type @error('reward_type') is-invalid @enderror">
                                                                    <option value="">Select Nature of Reward</option>
                                                                    <option {{$eachInvestmentReward->reward_type === 'cash' ? 'selected':'' }} value="cash">Reward for Investment Is In Cash</option>
                                                                    <option {{$eachInvestmentReward->reward_type === 'kind' ? 'selected':'' }} value="kind">Reward for Investment Is In Kind</option>
                                                                </select>
                                                                @error('reward_type')
                                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="reward">{{ __('Description of Reward') }}</label>
                                                                <input type="text" id="reward_type1" name="reward[]" class="form-control @error('reward_type') is-invalid @enderror" required data-error="Description of Reward is required" placeholder="Description of Reward" value="{{$eachInvestmentReward->reward}}"  />
                                                                @error('reward_type')
                                                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 {{$eachInvestmentReward->reward_type === 'cash' ? '':'hidden'}} amount_holder">
                                                            <div class="form-group">
                                                                @php $rewardAmountDetails = auth()->user()->getAmountForView($eachInvestmentReward->amount); @endphp
                                                                @php $mainRewardAmount = round($rewardAmountDetails['data']['amount']); @endphp
                                                                <label for="amount">{{ __('Amount') }} ({{$rewardAmountDetails['data']['currency']}})</label>

                                                                <input type="text" id="amount" name="amount[]" class="form-control @error('amount') is-invalid @enderror" data-error="Amount" placeholder="Amount" value="{{$mainRewardAmount}}"  />
                                                                @error('amount')
                                                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <div  class="col-sm-12 reward_field_adder" style="margin-bottom: 20px;">
                                            <button onclick="addNewRewardField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn guoBtn">Update Investment Plan</button>
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
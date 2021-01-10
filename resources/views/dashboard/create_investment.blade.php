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
                                <h2 style="color:white;">Wallet Balance</h2>
                            </div>

                            <div class="col-sm-12">
                                @php $balanceDetails = auth()->user()->getUserBalanceForView(auth()->user()->unique_id) @endphp
                                <h5 style="color:white;"><span>Main Balance: </span> <span>{{$balanceDetails['currency']}} {{number_format($balanceDetails['main'], 2)}}</span></h5>
                                <h5 style="color:white;"><span>Pending Withdrawal Balance: </span> <span>{{$balanceDetails['currency']}} {{number_format($balanceDetails['withdrawn'], 2)}}</span></h5>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Create Investment</h2>
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
                            @php $currencyDetails = auth()->user()->currency_details @endphp
                            <div class="col-sm-12" >
                                <div class="row">
                                    <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('create_an_investment') }}" class="log-form">
                                        @csrf

                                        @php $amountdetails = auth()->user()->currency_details @endphp
                                        <div class="col-12 faqs_fields_holder" style="padding-left: 20px; padding-right: 20px;" data-count-holder="1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_">Select a Package</label>
                                                        <select onchange="showInvestDetails(this)" name="investment_settings_id" id="investment_settings_id" class="form-control @error('investment_settings_id') is-invalid @enderror">
                                                            <option value="">Select A Package</option>
                                                            @if(count($investments) > 0)
                                                                @foreach($investments as $k => $eachInvestments)
                                                                    @php $minAmountDetails = auth()->user()->getAmountForView($eachInvestments->amount) @endphp
                                                                    <option value="{{$eachInvestments->unique_id}}">{{ucwords($eachInvestments->name_of_plan)}} ({{$minAmountDetails['data']['currency']}} {{number_format(round($minAmountDetails['data']['amount']), 2)}})</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('investment_settings_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">

                                                        <label for="amount">Referral Code </label>
                                                        <input type="text" value="{{ $refId ?? old('referral_id') }}" name="referral_id" class="form-control" placeholder="Referral Code"  />
                                                    </div>
                                                    @error('referral_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 hidden hiddenDiv">
                                                    <div class="form-group">

                                                        <label for="amount">Amount ({{$currencyDetails->second_currency}})</label>
                                                        <input type="text" id="amount_" value="{{old('amount')}}" name="amount" class="form-control" placeholder="Amount"  />
                                                    </div>

                                                </div>

                                                <div class="col-12 hidden hiddenDiv">
                                                        <div class="form-group">

                                                            <label for="amount">Form Fee ({{$currencyDetails->second_currency}})</label>
                                                            <input type="text" id="amount_for_form" value="{{old('amount_for_form')}}" name="amount" class="form-control" placeholder="Amount"  />
                                                        </div>

                                                </div>

                                                <div class="col-12 hidden hiddenDiv" >
                                                    <div class="form-group">

                                                        <label for="amount">Duration (days)</label>
                                                        <input type="text" id="duration_in_days" value="{{old('duration_in_days')}}" name="duration_in_days" class="form-control" placeholder="Amount"  />
                                                    </div>

                                                </div>

                                                <div class="col-12 hidden hiddenDiv list_of_rewards">



                                                </div>



                                            </div>
                                        </div>

                                        <div class="col-12" style="margin-top:30px; padding-left: 10px; padding-right: 10px;">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                            </div>
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
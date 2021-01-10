@php $pageTitle = 'All Investments' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Investments History</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Investments History</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            {{--@if(auth()->user()->type_of_user === 'user')--}}

            {{--@endif--}}

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-danger"><b>Investments History</b> {{--<div class="pull-right">  <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmDispensation(this)" class="btn btn-info guoBtn">confirm Dispensation of Reward</a> </div>--}} </h4>
                        <div>
                            <form action="{{route('show_investments_by_date', [$investmentSettings->unique_id, 'history'])}}" method="post">
                                @csrf
                                <h5>Filter With Date</h5>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <input type="date" class="form-control" placeholder="Start Date" name="start_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <input class="form-control" type="date" placeholder="End Date" name="end_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <button  class="btn btn-info" type="submit">Go</button>
                                    </div>
                                    <hr style="color: #fff;" size="10">
                                </div>
                            </form>
                        </div>




                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                    @if(auth()->user()->type_of_user === 'admin')
                                        <th class="text-center">Full Name <br>(Email Address)</th>
                                    @endif
                                    <th class="text-center">Name of Package <br>Investment Status</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Referral Code</th>
                                    <th class="text-center">Investment Rewards</th>
                                    <th class="text-center">Date Created <br>(Duration)</th>
                                    <th class="text-center">Time Remaining in Days <br>(Due Date)</th>
                                    <th class="text-center">Number of Referrals</th>
                                    <th class="text-center">Options</th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @php $transExist = 0 @endphp
                                @php $allInvestments = $investmentSettings->Investment_details @endphp
                                @if(count($allInvestments) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp
                                    @foreach($allInvestments as $k => $eachInvestmentDetails)

                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <span>{{$count}}</span>
                                            </td>
                                            <td class="text-center sorting_1">
                                                <input type="checkbox" class="smallCheckBox" value="{{$eachInvestmentDetails->unique_id}}">
                                            </td>
                                            @if(auth()->user()->type_of_user === 'admin')
                                                <td class="text-center">{{$eachInvestmentDetails->UserDetails->name}}<br> ({{$eachInvestmentDetails->UserDetails->email}})</td>
                                            @endif
                                            <td class="text-center">
                                                <span>{{$eachInvestmentDetails->InvestmentPlan->investment_title}}</span>
                                                <br><span class="label label-{{$eachInvestmentDetails->returnStatusDetails($eachInvestmentDetails->status)}}">{{ucwords(str_replace('_', ' ', $eachInvestmentDetails->status))}}</span></td>
                                            @php
                                                $amountForInvestment = auth()->user()->getAmountForView($eachInvestmentDetails->InvestmentPlan->min_investment_amount)
                                            @endphp
                                            <td class="text-center">{{$amountForInvestment['data']['currency']}} {{number_format(round($amountForInvestment['data']['amount']))}}</td>

                                            <td class="text-center">

                                                <input type="text" @if($eachInvestmentDetails->status !== 'active') {{'disabled'}} @endif id="refIdHolder{{$count}}" value="{{$eachInvestmentDetails->referral_id}}" class="form-control">
                                                @if($eachInvestmentDetails->status === 'active')
                                                    <button type="button" class="btn guoBtn copybtn" data-clipboard-target="#refIdHolder{{$count}}" >Copy Referral ID</button>
                                                @endif
                                            </td>


                                            @php $InvestmentRewardCheck = $eachInvestmentDetails->InvestmentRewardCheck @endphp
                                            @if(count($InvestmentRewardCheck) > 0)
                                                <td class="text-center sorting_1">

                                                    <div class="row" style="">
                                                        @foreach($InvestmentRewardCheck as $k => $eachInvestmentRewardCheck)
                                                            <div class="col-sm-12 text-left">
                                                                <span style="color:darkred;">* </span>
                                                                @if(auth()->user()->privilegeChecker('confirm_disbursed_incentive') && $eachInvestmentRewardCheck->status !== 'done')
                                                                    <span><input type="checkbox" class="smallCheckBox2" value="{{$eachInvestmentRewardCheck->unique_id}}"></span>
                                                                @endif

                                                                @php
                                                                    $eachReward = $eachInvestmentRewardCheck->EachInvestmentReward;
                                                                    if($eachInvestmentRewardCheck->reward_type !== 'kind'){
                                                                        $rewardAmount = auth()->user()->getAmountForView($eachInvestmentRewardCheck->amount);
                                                                        $reward = '('.$rewardAmount['data']['currency'].') '.number_format($rewardAmount['data']['amount']);
                                                                    }else{
                                                                        $reward = $eachReward->reward;
                                                                    }

                                                                @endphp
                                                                <span>{{$reward}}</span> <span class="label label-{{$eachInvestmentRewardCheck->status === 'pending' ? 'warning':'success'}}">{{ucfirst($eachInvestmentRewardCheck->status)}}</span>


                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </td>

                                            @endif

                                            <td class="text-center">{{$eachInvestmentDetails->created_at}}<br>({{round($eachInvestmentDetails->InvestmentPlan->duration_in_days).' Days'}})</td>
                                            @php
                                                $expirationDate = \Carbon\Carbon::parse($eachInvestmentDetails->created_at)->addDays($eachInvestmentDetails->time_remaining_in_days)->toDateTimeString();
                                            @endphp
                                            <td class="text-center">{{round($eachInvestmentDetails->time_remaining_in_days).' Days'}}<br> ({{$expirationDate}})</td>
                                            <td class="text-center"> {{$eachInvestmentDetails->ReferralDetails($eachInvestmentDetails->referral_id)->count()}}</td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Options</button>

                                                    <!--view user details-->
                                                    <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">

                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('investment_referral', [$eachInvestmentDetails->unique_id])}}">View Referrals</a></button>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        @php $count++ @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>


                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>
    </div>
    <style>
        th, td{
            font-size: 12px !important;
        }
    </style>

@endsection

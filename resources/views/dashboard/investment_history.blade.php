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
                                <h2 style="color:white;">Investment History</h2>
                            </div>

                            <div class="col-sm-12 table-responsive" >
                                <table id="myTable" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                    <thead style="color:white;">
                                    <tr>
                                        <th class="text-center">S / N</th>
                                        <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                        @if(auth()->user()->type_of_user !== 'user')
                                            <th class="text-center">Full Name <br>(Email Address)</th>
                                        @endif
                                        <th class="text-center">Name of Package <br>Investment Status</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Referral Link</th>
                                        <th class="text-center">Investment Rewards</th>
                                        <th class="text-center">Date Created <br>(Duration)</th>
                                        <th class="text-center">Time Remaining in Days {{--<br>(Due Date)--}}</th>
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

                                                @if(auth()->user()->type_of_user !== 'user')
                                                    <td class="text-center">{{$eachInvestmentDetails->UserDetails->name}}<br> ({{$eachInvestmentDetails->UserDetails->email}})</td>
                                                @endif
                                                <td class="text-center">
                                                    <span>{{$eachInvestmentDetails->InvestmentPlan->name_of_plan}}</span>
                                                    <br><span class="label label-{{$eachInvestmentDetails->returnStatusDetails($eachInvestmentDetails->status)}}">{{ucwords(str_replace('_', ' ', $eachInvestmentDetails->status))}}</span></td>
                                                @php
                                                    $amountForInvestment = auth()->user()->getAmountForView($eachInvestmentDetails->InvestmentPlan->amount)
                                                @endphp
                                                <td class="text-center">{{$amountForInvestment['data']['currency']}} {{number_format(round($amountForInvestment['data']['amount']))}}</td>

                                                <td class="text-center">

                                                    <div class="input-group mb-3">
                                                        <input @if($eachInvestmentDetails->status !== 'active') {{'disabled'}} @endif id="refLink2Holder{{$count}}" value="{{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}" type="text" class="form-control" aria-describedby="button-addon2">
                                                        @if($eachInvestmentDetails->status === 'active')
                                                            <div class="input-group-append">
                                                                <button class="copybtn btn btn-outline-secondary" type="button" id="button-addon2" style="background-color:#080E32;" data-clipboard-target="#refLink2Holder{{$count}}" >Copy Referral Link</button>
                                                            </div>
                                                        @endif
                                                    </div>

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

                                                <td class="text-center">{{$eachInvestmentDetails->created_at}}<br>({{round($eachInvestmentDetails->InvestmentPlan->duration_for_referral_reward).' Days'}})</td>
                                                @php
                                                    $expirationDate = \Carbon\Carbon::parse($eachInvestmentDetails->created_at)->addDays($eachInvestmentDetails->time_remaining_in_days)->toDateTimeString();
                                                @endphp
                                                <td class="text-center">{{round($eachInvestmentDetails->time_remaining_in_days).' Days'}}<br> {{--({{$expirationDate}})--}}</td>
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

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
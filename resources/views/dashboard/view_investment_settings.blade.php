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

                            <div class="col-sm-6">
                                <h2 style="color:white;">Investment Packages</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right"><a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deletePlans(this)" class="btn btn-info guoBtn">Delete Plan(s)</a> </div>
                            </div>

                            <div class="col-sm-12" >
                                <div class="row">
                                    @if(count($investmentSettings) > 0)
                                        @foreach($investmentSettings as $k => $eachInvestmentSettings)
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div style="position: absolute; left: 30px; top: 30px; z-index: 30;">
                                                    @if(auth()->user()->type_of_user !== 'user')
                                                        <input type="checkbox" title="Select this investment by ticking the checkbox" class="smallCheckBox" value="{{$eachInvestmentSettings->unique_id}}"  />
                                                    @endif
                                                </div>
                                                <div class="hpanel hbgblue responsive-mg-b-30">
                                                    <div class="panel-body">
                                                        <div class="text-center content-bg-pro">
                                                            <h3>{{$eachInvestmentSettings->name_of_plan}}</h3>
                                                            @php $minAmountDetails = auth()->user()->getAmountForView($eachInvestmentSettings->amount) @endphp
                                                            @php $earningForRefDetails = auth()->user()->getAmountForView($eachInvestmentSettings->amount_for_referral) @endphp
                                                            @php $earningForNoRefDetails = auth()->user()->getAmountForView($eachInvestmentSettings->amount_for_no_referral) @endphp
                                                            <p class="text-big font-light">
                                                                Enroll with ({{$minAmountDetails['data']['currency']}}) {{$minAmountDetails['data']['amount']}}
                                                            </p>
                                                            {{--<small>
                                                                Earn ({{$earningForRefDetails['data']['currency']}}) {{$earningForRefDetails['data']['amount']}} after {{$eachInvestmentSettings->duration_for_referral_reward}} days when you refer {{$eachInvestmentSettings->maximum_no_of_referral}} persons or ({{$earningForNoRefDetails['data']['currency']}}) {{$earningForNoRefDetails['data']['amount']}} after {{$eachInvestmentSettings->duration_for_referral_reward}} days when you didnt refer upto {{$eachInvestmentSettings->maximum_no_of_referral}} persons
                                                            </small>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                                                    <div class="hpanel responsive-mg-b-30">
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>
                                                                            You earn the following:
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="text-success font-bold"> ({{$earningForRefDetails['data']['currency']}}) {{$earningForRefDetails['data']['amount']}} after {{$eachInvestmentSettings->duration_for_referral_reward}} days when you refer {{$eachInvestmentSettings->maximum_no_of_referral}} persons or ({{$earningForNoRefDetails['data']['currency']}}) {{$earningForNoRefDetails['data']['amount']}} after {{$eachInvestmentSettings->duration_for_referral_reward}} days when you didnt refer upto {{$eachInvestmentSettings->maximum_no_of_referral}} persons </span>
                                                                        </td>
                                                                    </tr>
                                                                    @php $rewardsDetails = $eachInvestmentSettings->rewardsDetails @endphp
                                                                    {{--reward,amount,reward_type--}}
                                                                    <!-- Ticket Pricing Table Details -->

                                                                    @if(count($rewardsDetails) > 0)
                                                                        @foreach($rewardsDetails as $l => $eachRewardDetails)
                                                                            <tr>
                                                                                @php
                                                                                    $reward = $eachRewardDetails->reward;
                                                                                @endphp

                                                                                    <td colspan="2">
                                                                                        <span class="text-success font-bold">{{$reward}}</span>
                                                                                    </td>

                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <tr>
                                                                        <td>
                                                                            <a style="color:white;" target="_blank" href="{{route('view_investments', [$eachInvestmentSettings->unique_id, auth()->user()->type_of_user === 'user'? auth()->user()->unique_id : ''])}}" class="btn btn-block btn-primary w-100 ">{{auth()->user()->type_of_user === 'User'? 'View My Investments' : 'View Investments'}} <i class="fa fa-eye"></i> <span class="badge badge-danger"> {{$eachInvestmentSettings->getAtivePlans($eachInvestmentSettings->unique_id)->count()}}</span></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <a style="color:white;" target="_blank" href="{{route('view_due_investments', [$eachInvestmentSettings->unique_id, auth()->user()->type_of_user === 'user'? auth()->user()->unique_id : ''])}}" class="btn btn-block btn-primary w-100 ">{{auth()->user()->type_of_user === 'user'? 'View My Due Investments' : 'View Due Investments'}} <i class="fa fa-eye"></i> <span class="badge badge-danger">{{$eachInvestmentSettings->getDuePlans($eachInvestmentSettings->unique_id)->count()}}</span></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <a style="color:white;" target="_blank" href="{{route('view_investment_history', [$eachInvestmentSettings->unique_id, auth()->user()->type_of_user === 'user'? auth()->user()->unique_id : ''])}}" class="btn btn-block btn-primary w-100 ">{{auth()->user()->type_of_user === 'user'? 'History' : 'History'}} <i class="fa fa-eye"></i> <span class="badge badge-danger">{{$eachInvestmentSettings->getInactivePlans($eachInvestmentSettings->unique_id)->count()}}</span></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            @if(auth()->user()->privilegeChecker('edit_investments'))
                                                                                <a style="color:white;" target="_blank" href="{{route('edit_investment_settings_page', [$eachInvestmentSettings->unique_id])}}" class="btn btn-block btn-primary w-100">Edit Investments Package<i class="fa fa-edit"></i></a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
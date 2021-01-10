@php $pageTitle = 'Home Page' @endphp
@extends('layouts.design')

@section('content')

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="dashboard-area">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Welcome {{ Auth::user()->name }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    @if(auth()->user()->admin_level === 'main' && auth()->user()->type_of_user === 'admin')
                    <div class="col-md-6 col-lg-6">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class=' fa fa-money'></i></div>
                                    <h5 class="font-14 mt-0">Number of Pending Withdrawals</h5>

                                    <h3 class="mt-3 mb-3 font-20">{{$allPendingWithdrawals->count()}} </h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 6.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class=' fa fa-money'></i></div>
                                    <h5 class="font-14 mt-0">Number of Pending Top Ups</h5>

                                    <h3 class="mt-3 mb-3 font-20">{{$allPendingToUp->count()}} </h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 6.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class=' fa fa-money'></i></div>
                                    <h5 class="font-14 mt-0">{{auth()->user()->type_of_user === 'admin' ? 'Overall':''}}  Wallet Balance</h5>
                                    @php $walletAmountDetails = auth()->user()->type_of_user === 'admin' ? auth()->user()->getAmountForView($walletBalance->sum('balance')) : auth()->user()->getAmountForView($walletBalance->balance) @endphp
                                    <h3 class="mt-3 mb-3 font-20">{{$walletAmountDetails['data']['currency']}} {{number_format(round($walletAmountDetails['data']['amount']))}}</h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 6.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='fa fa-bar-chart'></i></div>
                                    <h5 class="font-14 mt-0">No. of Active Investments</h5>
                                    <h3 class="mt-3 mb-3 font-20">{{$getActiveInvestments->count()}}</h3>
                                    {{--<p class="mb-0"><span class="text-danger mr-2"><i class='bx bx-trending-down font-16'></i> 1.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='fa fa-bar-chart'></i></div>
                                    <h5 class="font-14 mt-0">No. of Active & Completed Investments</h5>
                                    <h3 class="mt-3 mb-3 font-20">{{$getAmountSpentOnInvestment->count()}}</h3>
                                    {{--<p class="mb-0"><span class="text-danger mr-2"><i class='bx bx-trending-down font-16'></i> 1.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='fa fa-bar-chart'></i></div>
                                    <h5 class="font-14 mt-0">No. of Completed Investments</h5>
                                    <h3 class="mt-3 mb-3 font-20">{{$getAmountGotFromInvestment->count()}}</h3>
                                    {{--<p class="mb-0"><span class="text-danger mr-2"><i class='bx bx-trending-down font-16'></i> 1.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='bx bx-dollar single-widget-icon'></i></div>
                                    <h5 class="font-14 mt-0">Total Amount From Completed and Active Investments</h5>
                                    @php $totalAmountSpent = 0 @endphp
                                    @if(count($getAmountSpentOnInvestment) > 0)
                                        @foreach($getAmountSpentOnInvestment as $eachInvestment)
                                            @php $totalAmountSpent += $eachInvestment->InvestmentPlan->min_investment_amount @endphp
                                        @endforeach
                                    @endif
                                    @php $amountSpentDetails = auth()->user()->getAmountForView($totalAmountSpent) @endphp
                                    <h3 class="mt-3 mb-3 font-20"> {{$amountSpentDetails['data']['currency']}} {{number_format(round($amountSpentDetails['data']['amount']))}}</h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 9.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='bx bx-dollar single-widget-icon'></i></div>
                                    <h5 class="font-14 mt-0">Total Amount From Active Investments</h5>
                                    @php $totalAmountOnActiveInvestments = 0 @endphp
                                    @if(count($getActiveInvestments) > 0)
                                        @foreach($getActiveInvestments as $eachInvestment)
                                            @php $totalAmountOnActiveInvestments += $eachInvestment->InvestmentPlan->min_investment_amount @endphp
                                        @endforeach
                                    @endif
                                    @php $amountSpentDetails = auth()->user()->getAmountForView($totalAmountOnActiveInvestments) @endphp
                                    <h3 class="mt-3 mb-3 font-20"> {{$amountSpentDetails['data']['currency']}} {{number_format(round($amountSpentDetails['data']['amount']))}}</h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 9.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='bx bx-dollar single-widget-icon'></i></div>
                                    @php $totalAmountGot = 0 @endphp
                                    @if(count($getAmountGotFromInvestment) > 0)
                                        @foreach($getAmountGotFromInvestment as $eachInvestment)
                                            @php $totalAmountGot += $eachInvestment->InvestmentPlan->min_investment_amount @endphp
                                        @endforeach
                                    @endif
                                    <h5 class="font-14 mt-0">Total Amount From Completed Investments</h5>
                                    @php $amountGottenDetails = auth()->user()->getAmountForView($totalAmountGot) @endphp
                                    <h3 class="mt-3 mb-3 font-20"> {{$amountGottenDetails['data']['currency']}} {{number_format(round($amountGottenDetails['data']['amount']))}}</h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 9.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Single Widget -->
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widger-cart mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right"><i class='bx bx-dollar single-widget-icon'></i></div>
                                    <h5 class="font-14 mt-0">Total Number of Due Investments</h5>
                                    <h3 class="mt-3 mb-3 font-20"> {{$DueInvestments->count()}} </h3>
                                    {{--<p class="mb-0"><span class="text-success mr-2"><i class='bx bx-trending-up font-16'></i> 9.28%</span><span>Since last month</span></p>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-6 col-lg-6 ">
                        <div class="card mb-30">
                            <div class="card-body">
                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="widgets-card-title">
                                        <h5 class="card-title mb-0">Summary of Investments</h5>
                                    </div>
                                    <div class="dashboard-dropdown">
                                        {{--<div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dashboardDropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dashboardDropdown1">
                                                <a class="dropdown-item" href="#"><i class="ti-pencil-alt"></i> Edit</a>
                                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                                <a class="dropdown-item" href="#"><i class="ti-eraser"></i> Remove</a>
                                                <a class="dropdown-item" href="#"><i class="ti-trash"></i> Delete</a>
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>

                                <!-- Chart Area apexdonutchart -->
                                <div id="grandourChart"></div>

                                <!-- Product Info -->
                                <div class="row mt-20">
                                    <div class="col-6 mb-15 text-center">
                                        <h6 class="mb-0 font-14"><i class='bx bxs-bowling-ball text-primary font-12'></i> Active Investments : {{$getActiveInvestments->count()}}</h6>
                                    </div>
                                    <div class="col-6 mb-15 text-center">
                                        <h6 class="mb-0 font-14"><i class='bx bxs-bowling-ball text-blue-cu font-12'></i> Due Investments : {{$DueInvestments->count() }}</h6>
                                    </div>
                                    <div class="col-6 mb-15 text-center">
                                        <h6 class="mb-0 font-14"><i class='bx bxs-bowling-ball text-success font-12'></i> Completed Investments : {{$getAmountGotFromInvestment->count()}}</h6>
                                    </div>
{{--                                    <div class="col-6 mb-15 text-center">--}}
{{--                                        <h6 class="mb-0 font-14"><i class='bx bxs-bowling-ball text-warning font-12'></i> Others : 33K</h6>--}}
{{--                                    </div>--}}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="widgets-card-title">
                                        <h5 class="card-title mb-0">News Updates</h5>
                                    </div>

                                    <div class="dashboard-dropdown">

                                    </div>

                                </div>

                                <ul class="dashboard-active-timeline list-unstyled" id="dashboardTimeline">
                                    @if(count($news) > 0)
                                        @foreach($news as $eachNews)
                                    <li style="cursor: pointer;" onclick="openNewsPage('news-details', '{{$eachNews->unique_id}}')" class="d-flex align-items-center mb-15">
                                        <div class="timeline-icon bg-primary mr-3">
                                            <i class="fa fa-bullhorn"></i>
                                        </div>
                                        <div class="timeline-info">
                                            <h6 class="mb-2 font-15">{{$eachNews->title}}</h6>
                                            {{--<span>@php echo substr($eachNews->news, 0, 100)  @endphp</span>--}}
                                            <p class="mb-0 font-13 text-left">{{$eachNews->created_at->diffForHumans() }}</p>
                                        </div>

                                    </li>
                                        @endforeach
                                    @else
                                        <li class="d-flex align-items-center mb-15">
                                            <div class="timeline-icon bg-primary mr-3">
                                                <i class="fa fa-bullhorn"></i>
                                            </div>
                                            <div class="timeline-info">
                                                <h6 class="mb-2 font-15">No Data Available</h6>
                                                {{--<span>@php echo substr($eachNews->news, 0, 100)  @endphp</span>
                                                <p class="mb-0 font-13 text-left">{{$eachNews->created_at->diffForHumans() }}</p>--}}
                                            </div>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Revenue Area -->
                    <div class="col-lg-12">
                        <div class="card mb-30">
                            <div class="card-body">
                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="widgets-card-title" style="width: 100%;">
                                        <h5 class="card-title mb-0">Referral Links</h5>
                                        <p class="alert-info alert">Referral ID are unique for each investment you create, therefore when one uses a referral ID for an investment you created to register for a package on our platform. The referral Reward (Deduction of Specified Number of Days from the total Duration of Affected Investment) only affects the investment that has that referral ID. Please click the 'Copy Referral ID' to copy your referral ID, Any user you invite to the platform has to provide this ID in the "Referral ID" field when registering for a package on our plaform. </p>
                                    </div>
                                </div>

                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th class="text-center">S / N<br><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                                <th class="text-center">Name of Package <br>Investment Status</th>
                                                <th class="text-center">Referral Link</th>
                                                <th class="text-center">Share on Facebook</th>
                                                <th class="text-center">Share on Twitter</th>
                                                <th class="text-center">Share on Whatsapp</th>
                                                <th class="text-center">Share on Telegram</th>
                                            </tr>
                                            </thead>

                                            <tbody class="usersHolds">
                                            @php $transExist = 0 @endphp
                                            @php $allInvestments = $getActiveInvestments @endphp
                                            @if(count($allInvestments) > 0)

                                                @php $count = 1 @endphp
                                                @php $totalAmount = 0 @endphp
                                                @foreach($allInvestments as $k => $eachInvestmentDetails)

                                                    <tr role="row" class="odd">
                                                        <td class="text-center sorting_1">
                                                            <span>{{$count}}</span><br>
                                                            <input type="checkbox" class="smallCheckBox" value="{{$eachInvestmentDetails->unique_id}}">
                                                        </td>
                                                        <td class="text-center">
                                                            <span>{{$eachInvestmentDetails->InvestmentPlan->investment_title}}</span>
                                                            <br><span class="label label-{{$eachInvestmentDetails->returnStatusDetails($eachInvestmentDetails->status)}}">{{ucwords(str_replace('_', ' ', $eachInvestmentDetails->status))}}</span></td>

                                                        <td class="text-center">

                                                            {{--<input type="text" @if($eachInvestmentDetails->status !== 'active') {{'disabled'}} @endif id="refIdHolder{{$count}}" value="{{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}" class="form-control">
                                                            @if($eachInvestmentDetails->status === 'active')
                                                                <button type="button" class="btn guoBtn copybtn" data-clipboard-target="#refIdHolder{{$count}}" >Copy Referral Link</button>
                                                            @endif--}}

                                                            <div class="input-group mb-3">
                                                                <input @if($eachInvestmentDetails->status !== 'active') {{'disabled'}} @endif type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" id="refLinkHolder{{$count}}" value="{{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}" aria-describedby="button-addon2">
                                                                @if($eachInvestmentDetails->status === 'active')
                                                                <div class="input-group-append">
                                                                    <button class="copybtn btn btn-outline-secondary" type="button" id="button-addon2" style="background-color:#080E32;" data-clipboard-target="#refLinkHolder{{$count}}" >Copy Referral Link</button>
                                                                </div>
                                                                @endif
                                                            </div>

                                                        </td>

                                                        <td class="text-center">
                                                            <strong>Share</strong><br>
                                                            <a style="background: #727cf5; color:white;" target="_blank" href="whatsapp://send?text={{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}" data-action="share/whatsapp/share" class="btn btn-lg btn-rounded btn-outline-primary mb-2 mr-2"><i class="ti-arrow-circle-down"></i> On WhatsApp</a>
                                                        </td>


                                                        <td class="text-center">
                                                            <a style="background: #17a2b8; color:white;" target="_blank" class="btn btn-lg btn-rounded btn-outline-info mb-2 mr-2" href="https://twitter.com/intent/tweet/{{URL::to('/')}}/investment_manager?ref={{$eachInvestmentDetails->referral_id}}"><i class="ti-twitter"></i> On Twitter</a>
                                                        </td>

                                                        <td class="text-center">
                                                            <a style="background: #6c757d; color:white;" target="_blank" class="btn btn-lg btn-rounded btn-outline-secondary mb-2 mr-2" href="https://t.me/share/url?url={{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}"><i class="ti-share"></i> On Telegram</a>
                                                        </td>

                                                        <td class="text-center">
                                                            <a style="background: #727cf5; color:white;" class="btn btn-lg btn-rounded btn-outline-primary mb-2 mr-2" href="https://www.facebook.com/sharer/sharer.php?u={{URL::to('/')}}/investment_manager/{{$eachInvestmentDetails->referral_id}}" target="_blank"><i class="ti-facebook"></i>On Facebook</a>
                                                        </td>


                                                    </tr>


                                                    @php $count++ @endphp
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Chart -->
                                {{--<div id="apex-stacked-bar-chart"></div>--}}
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Area -->
                    <div class="col-lg-12">
                        <div class="card mb-30">
                            <div class="card-body">
                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="widgets-card-title" style="width: 100%;">
                                        <h5 class="card-title mb-0">Active Investments</h5>
                                    </div>
                                </div>

                                <div class="card-header border-none bg-transparent d-flex align-items-center justify-content-between p-0 mb-30">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons_2" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th class="text-center">S / N<br><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                                @if(auth()->user()->type_of_user === 'admin')
                                                    <th class="text-center">Full Name <br>(Email Address)</th>
                                                @endif
                                                <th class="text-center">Name of Package <br>Investment Status</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Referral Code</th>
                                                <th class="text-center">Referral Link</th>
                                                <th class="text-center">Investment Rewards</th>
                                                <th class="text-center">Date Created <br>(Duration)</th>
                                                <th class="text-center">Time Remaining in Days <br>(Due Date)</th>
                                                <th class="text-center">Number of Referrals</th>
                                                <th class="text-center">Options</th>
                                            </tr>
                                            </thead>

                                            <tbody class="usersHolds">
                                            @php $transExist = 0 @endphp
                                            @php $allInvestments = $getActiveInvestments @endphp
                                            @if(count($allInvestments) > 0)

                                                @php $count = 1 @endphp
                                                @php $totalAmount = 0 @endphp
                                                @foreach($allInvestments as $k => $eachInvestmentDetails)

                                                    <tr role="row" class="odd">
                                                        <td class="text-center sorting_1">
                                                            <span>{{$count}}</span><br>
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

                                                            <div class="input-group mb-3">
                                                                <input @if($eachInvestmentDetails->status !== 'active') {{'disabled'}} @endif id="refIdHolder{{$count}}" value="{{$eachInvestmentDetails->referral_id}}" type="text" class="form-control" aria-describedby="button-addon2">
                                                                @if($eachInvestmentDetails->status === 'active')
                                                                    <div class="input-group-append">
                                                                        <button class="copybtn btn btn-outline-secondary" type="button" id="button-addon2" style="background-color:#080E32;" data-clipboard-target="#refIdHolder{{$count}}" >Copy Referral ID</button>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </td>

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
                                                                        <div class="col-sm-12">
                                                                            <span style="color:darkred;">* </span>
                                                                            {{--<span><input type="checkbox" class="smallCheckBox2" value="{{$eachInvestmentDetails->unique_id}}"></span>--}}

                                                                            @php
                                                                                $eachReward = $eachInvestmentRewardCheck->EachInvestmentReward;
                                                                                if ($eachReward->reward_type === 'cash'){
                                                                                    $amountDetails = auth()->user()->getAmountForView($eachReward->amount);
                                                                                    $reward = '('.$amountDetails['data']['currency'].') '.$amountDetails['data']['amount']. ' Cash Reward';
                                                                                }else{
                                                                                    $reward = $eachReward->reward;
                                                                                }
                                                                            @endphp
                                                                            <span>{{$reward}}</span>
                                                                            <span class="lable label-{{$eachInvestmentRewardCheck->status === 'pending' ? 'warning' : 'info'}}">{{$eachInvestmentRewardCheck->status}} </span>

                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </td>
                                                        @else
                                                            @php $investmentPlanDetails = $eachInvestmentDetails->InvestmentPlan @endphp
                                                            @php $investmentRewardDetails = $investmentPlanDetails->rewardsDetails @endphp
                                                            @if(count($investmentRewardDetails) > 0)
                                                                <td class="text-center sorting_1">
                                                                    @foreach($investmentRewardDetails as $l => $eachRewardDetails)
                                                                        <div class="col-sm-12" style="width: 300px;">
                                                                            <span style="color:darkred;">* </span>
                                                                            @php

                                                                                if ($eachRewardDetails->reward_type === 'cash'){
                                                                                    $amountDetails = auth()->user()->getAmountForView($eachRewardDetails->amount);
                                                                                    $reward = '('.$amountDetails['data']['currency'].') '.number_format(round($amountDetails['data']['amount'])). ' Cash Reward';
                                                                                }else{
                                                                                    $reward = $eachRewardDetails->reward;
                                                                                }
                                                                            @endphp
                                                                            <span>{{$reward}}</span>
                                                                            {{--<span class="lable label-warning">Pending </span>--}}
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                            @else
                                                                <td class="text-center sorting_1"></td>
                                                            @endif
                                                        @endif

                                                        <td class="text-center">{{$eachInvestmentDetails->created_at}}<br>({{round($eachInvestmentDetails->InvestmentPlan->duration_in_days).' Days'}})</td>
                                                        @php
                                                            $expirationDate = \Carbon\Carbon::parse($eachInvestmentDetails->created_at)->addDays($eachInvestmentDetails->time_remaining_in_days)->toDateTimeString();
                                                        @endphp
                                                        <td class="text-center">{{round($eachInvestmentDetails->time_remaining_in_days).' Days'}}<br> {{--({{$expirationDate}})--}}</td>
                                                        <td class="text-center"> {{$eachInvestmentDetails->ReferralDetails($eachInvestmentDetails->referral_id)->count()}}</td>

                                                        <td class="text-center">
                                                            <div class="btn-group mb-2">
                                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Options</button>
                                                                <div class="dropdown-menu">
                                                                    {{--@if($eachInvestmentDetails->ReferralDetails->count() > 0)--}}
                                                                    <a class="dropdown-item" href="{{route('investment_referral', [$eachInvestmentDetails->unique_id])}}" >View Referrals</a>
                                                                    {{--@endif--}}


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

                                <!-- Chart -->
                                {{--<div id="apex-stacked-bar-chart"></div>--}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <style>
        th, td{
            font-size: 12px !important;
        }
    </style>
@endsection
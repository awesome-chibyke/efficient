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
                                <h2 style="color:white;">All Referals</h2>
                            </div>

                            <div class="col-sm-12 table-responsive" >
                                <table id="myTable" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                    <thead style="color:white;">
                                    <tr>
                                        <th class="text-center">S / N</th>
                                        <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                        {{--@if(auth()->user()->type_of_user === 'admin')--}}
                                        <th class="text-center">Full Name of Down line <br>(Email Address)</th>
                                        {{--@endif--}}
                                        <th class="text-center">Name of Package</th>
                                        <th class="text-center">Date Created </th>
                                    </tr>
                                    </thead>

                                    <tbody class="usersHolds">
                                    @php $transExist = 0 @endphp

                                    @php $allReferrals = $investments->ReferralDetails($investments->referral_id); @endphp
                                    @if(count($allReferrals) > 0)

                                        @php $count = 1 @endphp
                                        @php $totalAmount = 0 @endphp

                                        @foreach($allReferrals as $k => $eachReferralDetails)

                                            <tr role="row" class="odd">
                                                <td class="text-center sorting_1">
                                                    <span>{{$count}}</span>
                                                </td>
                                                <td class="text-center sorting_1">
                                                    <input type="checkbox" class="smallCheckBox" value="{{$eachReferralDetails->unique_id}}" />
                                                </td>
                                                {{--@if(auth()->user()->type_of_user === 'admin')--}}
                                                @php $usersDetails = $investments->UserDetails2($eachReferralDetails->referred_user_id) @endphp
                                                {{-- @php $particularInvestmentDetails = $eachReferralDetails->InvestmentDetails2($eachReferralDetails->referral_id); @endphp--}}
                                                {{--@php $usersDetails = $particularInvestmentDetails->UserDetails; @endphp--}}
                                                <td class="text-center">{{$usersDetails->name}}<br> ({{$usersDetails->email}})</td>
                                                {{--@endif--}}


                                                <td class="text-center">{{$eachReferralDetails->MainInvestmentDetails->InvestmentPlan->name_of_plan}}</td>
                                                <td class="text-center">{{$eachReferralDetails->created_at}}</td>

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
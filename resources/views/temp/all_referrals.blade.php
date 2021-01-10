@php $pageTitle = 'Referrals' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">List of Referrals</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">List of Referrals</li>
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
                        <h4 class="text-danger"><b>List of Referrals you have under package {{$investments->InvestmentPlan->investment_title}}</b> <div class="pull-right">  {{--<a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmDispensation(this)" class="btn btn-info guoBtn">confirm Dispensation of Reward</a>--}} </div></h4>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-condensed table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                    {{--@if(auth()->user()->type_of_user === 'admin')--}}
                                    <th class="text-center">Full Name of Down line <br>(Email Address)</th>
                                    {{--@endif--}}
                                    <th class="text-center">Name of Package</th>
                                    <th class="text-center">No of Days Deducted</th>
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
                                                @php $usersDetails = $investments->UserDetails2($eachReferralDetails->referred_user_unique_id) @endphp
                                               {{-- @php $particularInvestmentDetails = $eachReferralDetails->InvestmentDetails2($eachReferralDetails->referral_id); @endphp--}}
                                                {{--@php $usersDetails = $particularInvestmentDetails->UserDetails; @endphp--}}
                                            <td class="text-center">{{$usersDetails->name}}<br> ({{$usersDetails->email}})</td>
                                            {{--@endif--}}


                                            <td class="text-center">{{$eachReferralDetails->MainInvestmentDetails->InvestmentPlan->investment_title}}</td>
                                            <td class="text-center">{{$eachReferralDetails->no_of_days_deducted}} Days</td>
                                            <td class="text-center">{{$eachReferralDetails->created_at}}</td>

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

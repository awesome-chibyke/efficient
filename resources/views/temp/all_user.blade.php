@php $pageTitle = 'Users' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">{{$mainTitle}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">{{$mainTitle}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">


            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-danger"><b>{{$mainTitle}}</b></h4>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>

                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center">Full Name</th>
                                    <th class="text-center">Email Address</th>
                                    <th class="text-center">Phone Number</th>
                                    @if($display === 'admin')<th class="text-center">Admin Level</th> @endif
                                    <th class="text-center">Account Status</th>
                                    {{--<th class="text-center">Number of Referrals</th>
                                    <th class="text-center"># of Active Referrals in the past 30 Days</th>--}}
                                    <th class="text-center">Wallet Balance ({{auth()->user()->currency_details->second_currency}})</th>
                                    <th class="text-center">Registration Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @if(count($allUsers) > 0)
                                    @php $count = 1; @endphp
                                    @foreach($allUsers  as $k => $eachUsers)
                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">{{$count}}</td>
                                            <td class="text-center">({{$eachUsers->name}})</td>
                                            <td class="text-center">{{$eachUsers->email}}</td>
                                            <td class="text-center">{{$eachUsers->phone}}</td>
                                            @if($display === 'admin')<th class="text-center">{{$eachUsers->admin_level}}</th> @endif
                                            {{--<td class="text-center">{{$eachUsers->gender}}</td>--}}
                                            <td class="text-center"><span class="label label-{{$eachUsers->status !== 'active' ? 'warning' : 'info'}} p-2">{{$eachUsers->status}}</span></td>
                                            {{--['all_count'=>$allCount, 'all_active_count'=>$allActiveCount]--}}
                                            {{--@php $referralCountDetails = $eachUsers->referralDetails($eachUsers->unique_id) @endphp
                                            <td class="text-center">{{$referralCountDetails['all_count']}}</td>
                                            <td class="text-center">{{$referralCountDetails['all_active_count']}}</td>--}}
                                            @php $userBalanceDetails = auth()->user()->getAmountForView($eachUsers->balance); @endphp
                                            <td class="text-center">({{$userBalanceDetails['data']['currency']}}) {{number_format(round($userBalanceDetails['data']['amount']))}}</td>
                                            <td class="text-center">{{$eachUsers->created_at}}</td>
                                            <td class="text-center">
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('profile', [$eachUsers->unique_id])}}" >Details</a>
                                            {{--@if($referralCountDetails['all_count'] > 0 || $referralCountDetails['all_active_count'] > 0)
                                                        <a class="dropdown-item" href="{{route('my_referrals', [$eachUsers->unique_id])}}" >View Referrals</a>
                                            @endif--}}
                                                        {{--@if(auth()->user()->admin_level !== 'sub_admin' && $display === 'admin')--}}
                                                        <a class="dropdown-item" href="{{route('editProfile', [$eachUsers->unique_id])}}" >Edit</a>
                                                        <a data-user-holder="{{$eachUsers->unique_id}}" class="dropdown-item" href="javascript:void(0)" onclick="{{$eachUsers->status==="active" ? "accountManager(this,'block_account')":"accountManager(this, 'unblock_account')"}}">{{$eachUsers->status==='active' ? 'Block':'Un-Block'}}</a>
                                                        {{--@endif--}}

                                                        @if(auth()->user()->type_of_user === 'admin' && auth()->user()->admin_level === 'main')
                                                            @if($eachUsers->type_of_user === 'admin')
                                                                <a onclick="accountManager(this, 'make_user')" data-user-holder="{{$eachUsers->unique_id}}" class="dropdown-item" href="javascript:void(0)">Reverse To Normal User</a>
                                                            @else
                                                                <a onclick="accountManager(this, 'make_admin')" data-user-holder="{{$eachUsers->unique_id}}" class="dropdown-item" href="javascript:void(0)">Make Admin</a>
                                                            @endif
                                                        @endif

                                                        @if($eachUsers->type_of_user === 'admin')
                                                            <div class="dropdown-divider"></div>
                                                            @if(auth()->user()->type_of_user === 'admin' && auth()->user()->admin_level === 'main')
                                                            <a data-user-holder="{{$eachUsers->unique_id}}" class="dropdown-item" onclick="accountManager(this, '{{$eachUsers->admin_level === 'main' ? 'make_sub_admin':'make_super_admin'}}')" href="javascript:void(0)">{{$eachUsers->admin_level === 'main' ? 'Make Sub-admin':'Make Super Admin'}} </a>

                                                            @endif
                                                        @endif

                                                        @if(strtolower(auth()->user()->email) === 'techocraftict@gmail.com')
                                                        <a class="dropdown-item" href="{{route('add_funds', [$eachUsers->unique_id])}}">Add funds</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $count++ @endphp
                                    @endforeach
                                @else

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>
    </div>

@endsection


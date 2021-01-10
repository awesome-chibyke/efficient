@php $pageName = 'TOP UP HISTORY' @endphp
@php $active = 'users' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">





                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">{{$mainTitle}}</h2>
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

                            <div class="col-sm-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-sm-12" style="margin-top: 10px; ">
                                        <div class="table-responsive" >
                                            <table id="myTable" class="table table-striped ">
                                                <thead style="color:white;">

                                                <tr>
                                                    <th class="text-center">S / N</th>
                                                    <th class="text-center">Full Name</th>
                                                    <th class="text-center">Email Address</th>
                                                    <th class="text-center">Phone Number</th>
                                                    <th class="text-center">Type of User</th>
                                                    <th class="text-center">Type of User</th>
                                                    <th class="text-center">Gender</th>
                                                    <th class="text-center">Main Wallet Balance ({{auth()->user()->currency_details->second_currency}})</th>
                                                    <th class="text-center">Pending Withdrawal Balance ({{auth()->user()->currency_details->second_currency}})</th>
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
                                                            <th class="text-center"><span class="label label-info">{{$eachUsers->type_of_user}}</span></th>
                                                            <td class="text-center">{{$eachUsers->gender}}</td>
                                                            <td class="text-center"><span class="label label-{{$eachUsers->status !== 'active' ? 'warning' : 'info'}} p-2">{{$eachUsers->status}}</span></td>

                                                            @php $userBalanceDetails =  auth()->user()->getUserBalanceForView($eachUsers->unique_id); @endphp
                                                            <td class="text-center">({{$userBalanceDetails['currency']}}) {{number_format(round($userBalanceDetails['main']))}}</td>
                                                            <td class="text-center">({{$userBalanceDetails['currency']}}) {{number_format(round($userBalanceDetails['withdrawn']))}}</td>
                                                            <td class="text-center">{{$eachUsers->created_at}}</td>
                                                            <td class="text-center">

                                                                <div class="btn-group">
                                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Options</button>
                                                                    <!--view user details-->
                                                                    <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('profile', [$eachUsers->unique_id])}}">Details</a></button>
                                                                        <!--edit user-->
                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('editProfile', [$eachUsers->unique_id])}}">Edit</a></button>

                                                                        <!--make user-->
                                                                        @if($eachUsers->type_of_user !== 'user')
                                                                            @if(auth()->user()->privilegeChecker('make_user'))
                                                                                <button type="button" tabindex="0" class=" btn btn-block">

                                                                                        <a onclick="accountManager(this, 'make_user')" data-user-holder="{{$eachUsers->unique_id}}" href="javascript:void(0)">Make User</a>

                                                                                </button>
                                                                            @endif
                                                                        @endif

                                                                        <!--make admin-->
                                                                        @if($eachUsers->type_of_user !== 'admin')
                                                                            @if(auth()->user()->privilegeChecker('make_admin'))
                                                                                <button type="button" tabindex="0" class=" btn btn-block">

                                                                                    <a onclick="accountManager(this, 'make_admin')" data-user-holder="{{$eachUsers->unique_id}}" href="javascript:void(0)">Make Admin</a>

                                                                                </button>
                                                                            @endif
                                                                        @endif

                                                                    <!--make super admin-->
                                                                        @if($eachUsers->type_of_user !== 'super_admin')
                                                                            @if(auth()->user()->privilegeChecker('make_super_admin'))
                                                                                <button type="button" tabindex="0" class=" btn btn-block">

                                                                                    <a onclick="accountManager(this, 'make_super_admin')" data-user-holder="{{$eachUsers->unique_id}}" href="javascript:void(0)">Make Super Admin</a>

                                                                                </button>
                                                                            @endif
                                                                        @endif

                                                                        <!--make user master-->
                                                                        @if($eachUsers->type_of_user !== 'master')
                                                                            @if(auth()->user()->privilegeChecker('make_master'))
                                                                                <button type="button" tabindex="0" class=" btn btn-block">

                                                                                    <a onclick="accountManager(this, 'make_master')" data-user-holder="{{$eachUsers->unique_id}}" href="javascript:void(0)">Make Master</a>

                                                                                </button>
                                                                            @endif
                                                                        @endif

                                                                        <!--add funds to users account-->
                                                                        @if(auth()->user()->privilegeChecker('add_funds'))
                                                                            <button type="button" tabindex="0" class=" btn btn-block">

                                                                                    <a href="{{route('add_funds', [$eachUsers->unique_id])}}">Add funds</a>
                                                                            </button>
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
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
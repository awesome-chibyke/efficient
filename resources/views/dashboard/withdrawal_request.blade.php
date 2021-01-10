@php $pageName = 'Withdrawal Requests' @endphp
@php $active = 'withdrawals' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Create A Withdrawal</h2>
                            </div>
                            <div class="col-sm-12">
                                @php $balanceDetails = auth()->user()->getUserBalanceForView(auth()->user()->unique_id) @endphp
                                <h5 style="color:white;"><span>Main Balance: </span> <span>{{$balanceDetails['currency']}} {{number_format($balanceDetails['main'], 2)}}</span></h5>
                                <h5 style="color:white;"><span>Pending Withdrawal Balance: </span> <span>{{$balanceDetails['currency']}} {{number_format($balanceDetails['withdrawn'], 2)}}</span></h5>
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

                                    <div class="col-sm-12" style="margin-top: 10px;">

                                        <div class="row">
                                            <div class="col-sm-12">

                                                <form action="{{route('make_withdrawal')}}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="amounter">Amount</label>
                                                            <input type="text" id="amounter" class="form-control" value="{{old('amount')}}" placeholder="Amount" name="amount" />
                                                            @error('amount')
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group  col-sm-4">
                                                            <label></label>
                                                            <button  class="btn btn-info btn-lg btn-block" type="submit">Submit</button>
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


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-6">
                                <h2 style="color:white;">Withdrawal Requests ({{$dates}})</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    @if(auth()->user()->privilegeChecker('pay_with_flutter_wave'))
                                        <a class="btn btn-primary guoBtn" onclick="makeTransferPayments(this)" href="javascript:;">Make Payment With Flutter Wave</a>
                                    @if(auth()->user()->privilegeChecker('confirm_withdrawals'))
                                    @endif
                                        <a class="btn btn-primary guoBtn" onclick="markAsPayed(this)" href="javascript:;">Confirm Withdrawals</a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-sm-12" style="margin-top: 10px;">

                                        <div class="row" >
                                            <div class="col-sm-12">

                                                <form action="{{route('show_withdrawals_transactions_by_date', [auth()->user()->type_of_user !== 'admin' ? auth()->user()->unique_id : ''])}}" method="post">
                                                    @csrf
                                                    <h5 style="color:white;">Filter With Date</h5>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4">
                                                            <label for="start_date">From</label>
                                                            <input type="date" class="form-control" placeholder="Start Date" id="start_date" name="start_date" >
                                                            @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-sm-4">
                                                            <label for="end_date">From</label>
                                                            <input class="form-control" type="date" placeholder="End Date" id="end_date" name="end_date" />
                                                            <input type="hidden" value="pending" name="type" />
                                                            @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-sm-4">
                                                            <label></label>
                                                            <button  class="btn btn-info btn-lg btn-block" type="submit">Filter</button>
                                                        </div>
                                                        <hr style="color: #fff;" size="10">
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-12" style="margin-top: 10px; ">
                                        <table id="myTable" class="table table-striped dt-responsive nowrap w-100">
                                            <thead style="color:white;">

                                            <tr>
                                                <th class="text-center">S / N</th>
                                                @if(auth()->user()->type_of_user !== 'user')
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox"  />
                                                    </th>
                                                @endif
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Full Name <br> (Email Address)</th>
                                                <th class="text-center">Bank Name</th>
                                                <th class="text-center">Account Number</th>
                                                <th class="text-center">Account Name</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Withdrawal Date</th>

                                            </tr>
                                            </thead>

                                            <tbody class="usersHolds" style="color:black;">
                                            @php $transExist = 0;
                                $totalAmount = 0;
                                            @endphp

                                            @if(count($withdrawals) > 0)
                                                @php $count = 1; @endphp
                                                @foreach($withdrawals  as $k => $eachWithdrawals)
                                                    <tr role="row" class="odd">

                                                        @php $amountDetails = $eachWithdrawals->getAmountForView($eachWithdrawals->amount) //convert the amount to user currency @endphp

                                                        <td class="text-center sorting_1">{{$count}}</td>
                                                        @if(auth()->user()->type_of_user !== 'user')
                                                        <td class="text-center sorting_1">
                                                            <input type="checkbox" class="smallCheckBox" value="{{$eachWithdrawals->unique_id}}"  />
                                                        </td>
                                                        @endif
                                                        <td class="text-center sorting_1">{{$eachWithdrawals->user_details->name}}<br> {{$eachWithdrawals->user_details->email}}</td>
                                                        @php $totalAmount += $amountDetails['data']['amount']; $transExist++; @endphp
                                                        @php $transactionCurrency = $amountDetails['data']['currency']; @endphp

                                                        <td class="text-center">({{$amountDetails['data']['currency'] }}) {{number_format($amountDetails['data']['amount'])}}</td>
                                                        <td class="text-center">{{$eachWithdrawals->user_details->bank}}</td>
                                                        <td class="text-center">{{$eachWithdrawals->user_details->account_number}}</td>
                                                        <td class="text-center">{{$eachWithdrawals->user_details->account_name}}</td>
                                                        @php
                                                            if($eachWithdrawals->status === 'pending'){
                                                             $status = 'Pending';
                                                             }else if($eachWithdrawals->status === 'processing'){
                                                              $status = 'Processing';
                                                              }else
                                                              {
                                                              $status = 'Payments Made';
                                                              }
                                                        @endphp
                                                        <td class="text-center"><span class="label label-{{$eachWithdrawals->status === 'pending' ? 'warning' : 'info'}} p-2">{{$status}}</span></td>
                                                        <td class="text-center">{{$eachWithdrawals->created_at}}</td>
                                                    </tr>
                                                    @php $count++ @endphp
                                                @endforeach
                                            @else

                                            @endif
                                            </tbody>
                                        </table>

                                        @if($transExist > 0)
                                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                <tr role="row">
                                                    <td class="text-center"></td>

                                                    <th ><strong>Total Amount for Withdrawal Request</strong></th>
                                                    <th style="text-align: right;"><strong>{{$transactionCurrency}} {{number_format($totalAmount)}}</strong></th>
                                                </tr>
                                            </table>
                                        @endif
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
@php $pageName = 'MY WALLET' @endphp
@php $active = 'wallet' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">





                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Add Funds To Wallet</h2>
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
                                    <div class="col-sm-6">
                                        <div class="widget-text-box">
                                            <h4>Amount</h4>
                                            <div class="form-select-list">
                                                <input type="text" id="account_topUp" name="amount" class="form-control" :value="{{'amount'}}" placeholder="Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="widget-text-box">
                                            <h4>Mode of Payment</h4>
                                            <div class="form-select-list">
                                                <select id="option_for_payment" name="option_for_payment" class="form-control">
                                                    <option value="">Select Mode of Payment</option>
                                                    <option selected value="flutter_wave_top_up">Top Via Payment Gateway</option>
                                                    @if (session('main_key'))
                                                        <option value="bank_top_up">Top Up via Bank Transfer or Deposit</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12" style="margin-top: 20px;">
                                        <button type="button" onclick="triggerTopup(this)" class="btn btn-info btn-lg btn-block">Add Fund</button>
                                    </div>

                                    <div class="col-sm-12" style="margin-top: 40px;">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2 style="color:white;">List of Pending Credit Transactions ({{$dates}})</h2>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="pull-right">
                                                    @if(auth()->user()->privilegeChecker('confirm_credit_transaction'))
                                                    <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmTopUp(this)" class="btn btn-info guoBtn">Confirm Transaction(s)</a>
                                                    @endif
                                                    @if(auth()->user()->privilegeChecker('delete_transactions'))
                                                    <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deleteSelectedTopUp(this)" class="btn btn-info guoBtn">Delete Transaction(s)</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">

                                                <form action="{{route('show_top_up_transactions_by_date', [auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id : ''])}}" method="post">
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
                                                        <div class="form-group col-sm-4">
                                                            <label for="end_date">To</label>
                                                            <input class="form-control" type="date" placeholder="End Date" id="end_date" name="end_date" >
                                                            @error('end_date')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-sm-4">
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
                                        <div class="table-responsive" >
                                            <table id="myTable" class="table">
                                                <thead style="color:white !important">
                                                <tr>
                                                    <th class="text-center">S / N</th>

                                                    @if(auth()->user()->type_of_user !== 'user')
                                                        <th class="text-center">
                                                            <input onclick="checkAll()" type="checkbox" class="mainCheckBox"  />
                                                        </th>
                                                    @endif

                                                    @if(auth()->user()->type_of_user !== 'user')
                                                        <th class="text-center">Full Name</th>
                                                        <th class="text-center">Email</th>
                                                    @endif
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action Type</th>
                                                    <th class="text-center">Reference</th>
                                                    <th class="text-center">Narations/Descrption</th>
                                                    <th class="text-center">Date Created</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody class="usersHolds" >
                                                @php $transExist = 0 @endphp
                                                @if(count($transactionDetails) > 0)

                                                    @php $count = 1; @endphp
                                                    @php $totalAmount = 0 @endphp
                                                    @foreach($transactionDetails as $k => $eachTransaction)

                                                        @if($eachTransaction->action_type  !== 'top_up')  @continue @endif {{--jump a transaction thats not a topup--}}

                                                        <tr role="row" class="odd" style="color:black !important;">
                                                            <td class="text-center sorting_1">
                                                                <span>{{$count}}</span>
                                                            </td>

                                                            @if(auth()->user()->type_of_user !== 'user')
                                                            <td class="text-center sorting_1">
                                                                    <input type="checkbox" class="smallCheckBox" value="{{$eachTransaction->unique_id}}">
                                                            </td>
                                                            @endif

                                                            @if(auth()->user()->type_of_user !== 'user')
                                                                @php $detailsOfUser = $eachTransaction->user_details @endphp
                                                                <td class="text-center">{{$detailsOfUser->name}}</td>
                                                                <td class="text-center">{{$detailsOfUser->email}}</td>
                                                            @endif

                                                            @php $ConversionDetails = $eachTransaction->getAmountForView($eachTransaction->amount) @endphp
                                                            @php $transactionAmount = $ConversionDetails['data']['amount'] @endphp
                                                            @php $transactionCurrency = $ConversionDetails['data']['currency'] @endphp

                                                            <td class="text-center">{{$transactionCurrency }} {{ number_format($transactionAmount) }}</td>

                                                            @php if($eachTransaction->status === 'confirmed'){
                                                $status = 'Confirmed';
                                                $labelColor = 'info';
                                            }else if($eachTransaction->status === 'pending'){
                                                $status = 'Pending';
                                                $labelColor = 'warning';
                                            }else if($eachTransaction->status === 'processing'){
                                                $status = 'Processing';
                                                $labelColor = 'warning';
                                            }else if($eachTransaction->status === 'failed'){
                                                $status = 'Failed';
                                                $labelColor = 'danger';
                                            }
                                                            @endphp
                                                            <td class="text-center"><span class="label label-{{$labelColor}} p-2">{{$status}}</span></td>

                                                            <td class="text-center">{{$eachTransaction->action_type}}</td>
                                                            @php

                                                                if($eachTransaction->top_up_option === 'flutter_wave_top_up'){
                                                                    $ref = $eachTransaction->reference;
                                                                }else if($eachTransaction->top_up_option === 'bank_top_up'){
                                                                    if($eachTransaction->image_name === null){
                                                                        $ref = 'None';
                                                                    }else{
                                                                    $link = auth()->user()->returnLink();
                                                                    /*$image = asset('storage/public/img/users/transactions/'.$eachTransaction->image_name);*/
                                                                    $image = asset($link.'users/transactions/'.$eachTransaction->image_name);
                                                                    $ref = "<div style='width:50px;'><a title='Please Click Image to View a larger size' target='_blank' href='".$image."' ><img src='".$image."' style='width:100%;' /></a></div>";

                                                                    }
                                                                }else{
                                                                    $ref = $eachTransaction->reference;
                                                                }

                                                            @endphp
                                                            <td class="text-center">@php echo $ref @endphp</td>
                                                            <td class="text-center">{{$eachTransaction->add_narrations}}</td>

                                                            <td class="text-center">{{$eachTransaction->created_at}}</td>
                                                            <td class="text-center">

                                                                <div class="btn-group">
                                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Options</button>

                                                                    <!--view user details-->
                                                                    <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">

                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('transaction_history',['unique_id'=>$eachTransaction->unique_id ])}}">View Transaction Details</a></button>

                                                                        @if($eachTransaction->top_up_option === 'bank_top_up')
                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('show_bank_transaction',[$eachTransaction->unique_id])}}">View Bank Transfer/Deposit Details</a></button>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        @php $totalAmount += $transactionAmount @endphp
                                                        @php $count++ @endphp
                                                        @php $transExist++ @endphp
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>

                                            @if($transExist > 0)
                                                <table id="myTable" class="table table-striped dt-responsive nowrap w-100">
                                                    <tr role="row">
                                                        <td class="text-center"></td>

                                                        <th ><strong>Total Amount Pending</strong></th>
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
    </div>

@endsection
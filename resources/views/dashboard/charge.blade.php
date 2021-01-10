@php $pageName = 'TOP UP HISTORY' @endphp
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
                                <h2 style="color:white;">Charges For Investment</h2>
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

                                                <form action="{{route('show_charges_by_date', [auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id : ''])}}" method="post">
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
                                                            <label></label><br><br>
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
                                            <table id="myTable" class="table table-striped ">
                                                <thead style="color:white;">
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
                                                    <th class="text-center">Action Type</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Status</th>

                                                    <th class="text-center">Amount Paid for Package</th>
                                                    <th class="text-center">Amount Paid for Form</th>

                                                    @if(auth()->user()->type_of_user === 'admin')
                                                        <th class="text-center">Status for Settlement for Collection Centers</th>
                                                    @endif

                                                    <th class="text-center">Date Created</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody class="usersHolds" style="color:black;">
                                                @php $transExist = 0 @endphp
                                                @if(count($transactionDetails) > 0)

                                                    @php $count = 1 @endphp
                                                    @php $totalAmount = 0 @endphp
                                                    @foreach($transactionDetails as $k => $eachTransaction)

                                                        @if($eachTransaction->action_type  !== 'expense')  @continue @endif {{--jump a transaction thats not a topup--}}

                                                        <tr role="row" class="odd">
                                                            <td class="text-center sorting_1">
                                                                <span>{{$count}}</span><br>
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

                                                            <td class="text-center">{{$eachTransaction->action_type}}</td>
                                                            @php

                                                                $ref = $eachTransaction->description;

                                                            @endphp
                                                            <td class="text-center">@php echo $ref @endphp</td>
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

                                                            @php
                                                                $mainAmountDetails = $eachTransaction->getAmountForView($eachTransaction->investment !== null && $eachTransaction->investment !== '' ? $eachTransaction->investment->main_amount:0) @endphp
                                                            <td class="text-center">{{$mainAmountDetails['data']['currency']}} {{number_format(round($mainAmountDetails['data']['amount']))}}</td>

                                                            @php
                                                                $formAmountDetails = $eachTransaction->getAmountForView($eachTransaction->investment !== null && $eachTransaction->investment !== '' ? $eachTransaction->investment->form_amount:0) @endphp
                                                            <td class="text-center">{{$formAmountDetails['data']['currency']}} {{number_format(round($formAmountDetails['data']['amount']))}}</td>

                                                            @php

                                                                if(@$eachTransaction->investment->form_amount_dispensation_status === 'pending'){
                                                                    $paymentStatusLabel = 'danger';
                                                                }else if(@$eachTransaction->investment->form_amount_dispensation_status === 'processing'){
                                                                    $paymentStatusLabel = 'warning';
                                                                }if(@$eachTransaction->investment->form_amount_dispensation_status === 'confirmed'){
                                                                    $paymentStatusLabel = 'info';
                                                                }
                                                            @endphp

                                                            @if(auth()->user()->type_of_user === 'admin')
                                                                <td class="text-center"> <span class="label label-{{$paymentStatusLabel}}">{{@$eachTransaction->investment->form_amount_dispensation_status}}</span></td>
                                                            @endif

                                                            <td class="text-center">{{$eachTransaction->created_at}}</td>
                                                            <td class="text-center">

                                                                <div class="btn-group mb-2">
                                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Options</button>
                                                                    <div class="dropdown-menu">

                                                                        <a class="dropdown-item" href="{{route('transaction_history',['unique_id'=>$eachTransaction->unique_id ])}}">View Transaction Details</a>
                                                                        <br>
                                                                        @if($eachTransaction->top_up_option === 'bank_top_up')
                                                                            <a class="dropdown-item" href="{{route('show_bank_transaction',[$eachTransaction->unique_id])}}">View Bank Transfer/Deposit Details</a>

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
                                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                                    <tr role="row">
                                                        <td class="text-center"></td>

                                                        <th ><strong>Total Amount</strong></th>
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
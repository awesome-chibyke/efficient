@php $pageTitle = 'Wallet' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Pending Credit Transactions</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Pending Credit Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            @if(auth()->user()->type_of_user === 'user')
            <div class="col-lg-12 col-sm-12 box-margin height-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <h6 class="text-danger ">Wallet Balance</h6>
                            <div class="row">

                                <div class="col-md-9 col-sm-12">
                                    <h1 class="f-m-sizes"><b>({{$userDetails->getBalanceForView()['data']['currency']}}) {{number_format(round($userDetails->getBalanceForView()['data']['amount']), 2)}} </b></h1>
                                </div>
                                <div class="col-md-12 col-sm-12 mt-4">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <label for="account_topUp">Amount</label>
                                            <input placeholder="Amount" type="text" class="form-control" id="account_topUp">
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="option_for_payment">Mode of Payment</label>
                                            <select class="form-control @error('option_for_payment') is-invalid @enderror" name="option_for_payment" id="option_for_payment">
                                                <option value="">Select Mode of Payment</option>
                                                <option selected value="flutter_wave_top_up">Top Via Payment Gateway</option>
                                                @if (session('main_key'))
                                                <option value="bank_top_up">Top Up via Bank Transfer or Deposit</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label></label>
                                            <button class="btn guoBtn btn-block" onclick="triggerTopup()">Add Fund</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-danger"><b>Pending Credit Transactions ({{$dates}})</b> @if(auth()->user()->type_of_user === 'admin')<div class="pull-right"><a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmTopUp(this)" class="btn btn-info guoBtn">Confirm Transaction(s)</a>@endif  @if(auth()->user()->admin_level === 'main')<a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deleteSelectedTopUp(this)" class="btn btn-info guoBtn">Delete Transaction(s)</a> </div> @endif</h4>
                        <div>
                            <form action="{{route('show_top_up_transactions_by_date', [auth()->user()->type_of_user !== 'admin' ? auth()->user()->unique_id : ''])}}" method="post">
                                @csrf
                                <h5>Filter With Date</h5>
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
                                        <label for="end_date">To</label>
                                        <input class="form-control" type="date" placeholder="End Date" id="end_date" name="end_date" >
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <label></label><br><br>
                                        <button  class="btn btn-info guoBtn" type="submit">Filter</button>
                                    </div>
                                    <hr style="color: #fff;" size="10">
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>

                                    <th class="text-center">@if(auth()->user()->type_of_user === 'admin')<input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /> @endif</th>

                                    @if(auth()->user()->type_of_user === 'admin')
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

                                <tbody class="usersHolds">
                                @php $transExist = 0 @endphp
                                @if(count($transactionDetails) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp
                                    @foreach($transactionDetails as $k => $eachTransaction)

                                        @if($eachTransaction->action_type  !== 'top_up')  @continue @endif {{--jump a transaction thats not a topup--}}

                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <span>{{$count}}</span>
                                            </td>

                                            <td class="text-center sorting_1">
                                                @if(auth()->user()->type_of_user === 'admin')
                                                    <input type="checkbox" class="smallCheckBox" value="{{$eachTransaction->unique_id}}">
                                                @endif
                                            </td>

                                            @if(auth()->user()->type_of_user === 'admin')
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

                                        <th ><strong>Total Amount Pending</strong></th>
                                        <th style="text-align: right;"><strong>{{$transactionCurrency}} {{number_format($totalAmount)}}</strong></th>
                                    </tr>
                                </table>
                            @endif
                        </div>


                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>
    </div>

@endsection

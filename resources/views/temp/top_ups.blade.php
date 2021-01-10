@php $pageTitle = 'Wallet Top Up' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Top Up Transactions</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Top Up Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            {{--<div class="col-lg-12 col-sm-12 box-margin height-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <h6 class="text-danger ">Available Balance --------------------</h6>
                            <div class="row">

                                <div class="col-md-9 col-sm-12">
                                    <h1 class="f-m-sizes"><b>{{number_format($userDetails->getBalanceForView()['data']['amount'], 2)}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
                                </div>
                                <div class="col-md-3 col-sm-12 mt-4">
                                    <button class="btn guoBtn pull-right" onclick="bringOutModalMain('.walletTopUp')">Account TopUp</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-danger"><b>Top Up Transaction(s) ({{$dates}})</b></h4>
                        <div>
                            <form action="{{route('show_top_up_transactions_by_date')}}" method="post">
                                @csrf
                                <h5>Filter With Date</h5>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <input type="date" class="form-control" placeholder="Start Date" name="start_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <input class="form-control" type="date" placeholder="End Date" name="end_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <button  class="btn btn-info" type="submit">Proceed</button>
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
                                    @if(auth()->user()->type_of_user === 'admin')
                                    <th class="text-center">Full Name</th>
                                    <th class="text-center">Email</th>
                                    @endif
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Action Type</th>
                                    <th class="text-center">Reference</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">

                                @if(count($transactionDetails) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp
                                    @foreach($transactionDetails as $k => $eachTransaction)

                                        @if($eachTransaction->action_type  !== 'top_up')  @continue @endif {{--jump a transaction thats not a topup--}}

                                    <tr role="row" class="odd">
                                        <td class="text-center sorting_1">{{$count}}</td>
                                        @if(auth()->user()->type_of_user === 'admin')
                                            @php $detailsOfUser = $eachTransaction->user_details @endphp
                                            <td class="text-center">{{$detailsOfUser->name}}</td>
                                            <td class="text-center">{{$detailsOfUser->email}}</td>
                                        @endif

                                        @php $ConversionDetails = $eachTransaction->getAmountForView($eachTransaction->amount) @endphp
                                        @php $transactionAmount = $ConversionDetails['data']['amount'] @endphp
                                        @php $transactionCurrency = $ConversionDetails['data']['currency'] @endphp

                                        <td class="text-center">{{$transactionCurrency }} {{ number_format($transactionAmount) }}</td>
                                        <td class="text-center">{{$eachTransaction->action_type}}</td>
                                        <td class="text-center">{{$eachTransaction->reference}}</td>
                                        <td class="text-center"><span class="label label-{{$eachTransaction->status === 'pending' ? 'warning' : ($eachTransaction->status === 'failed' ? 'danger' : 'info' )}} p-2">{{$eachTransaction->status}}</span></td>
                                        <td class="text-center">{{$eachTransaction->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{route('transaction_history',['unique_id'=>$eachTransaction->unique_id ])}}">
                                                <button class="btn btn-primary btn-xs">View Details<i class="bx bxs-eyedropper"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                        @php $totalAmount += $transactionAmount @endphp
                                    @php $count++ @endphp
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if(count($transactionDetails) > 0)
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <tr role="row">
                                    @if(auth()->user()->type_of_user === 'admin')
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    @endif
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    <th ><strong>Total Amount</strong></th>
                                    <th style="text-align: right;"><strong>{{$transactionCurrency}} {{number_format($transactionAmount)}}</strong></th>
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

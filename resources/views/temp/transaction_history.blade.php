@php $pageTitle = 'Transaction History Details' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Transaction History Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="/home">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('wallet')}}">Wallet</a>
                            </li>
                            <li class="breadcrumb-item active">Transaction History Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            <div class="col-lg-12 col-sm-12 box-margin height-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 col-sm-12">
                                <h2 class="f-m-sizes text-center">Details for Transaction</h2>
                                <h5 class="f-m-sizes text-center">Account Balance</h5>
                                <h4 class="f-m-sizes text-center mb-5">
                                    @php $balance = $userDetails->getBalanceForView() @endphp
                                    <b>{{number_format($balance['data']['amount'], 2), '.'}} ({{$balance['data']['currency']}})</b>
                                </h4>
                                <ul class="list-group list-group-unbordered wallet-overview-hold">
                                    <li class="list-group-item">
                                        <b>Amount</b>
                                        @php $amount = $transactionDetails->getAmountForView($transactionDetails->amount) @endphp
                                        <p class="pull-right">{{ number_format($amount['data']['amount'], 2)}}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Reference</b>
                                        <p class="pull-right"> {{ $transactionDetails->reference === null || $transactionDetails->reference === '' ? 'None' : $transactionDetails->reference }} </p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Action type</b>
                                        <p class="pull-right">{{$transactionDetails->action_type === 'top_up' ? 'Wallet Top Up' : ($transactionDetails->action_type === 'expense' ? 'Expense':'Withdrawal')}}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <p class="pull-right"><span style="color:white;" class="label label-{{$transactionDetails->status === 'pending' ? 'warning' : ($transactionDetails->status === 'confirmed' ? 'success' : 'danger' )}}" >{{$transactionDetails->status}}</span></p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Description</b>
                                        <p class="pull-right">{{$transactionDetails->description}}</p>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Date Created </b>
                                        <p class="pull-right">{{$transactionDetails->created_at}}</p>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

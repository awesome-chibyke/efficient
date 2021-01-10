@php $pageName = 'Gallery' @endphp
@php $active = 'gallery' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">





                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

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

                                    <div class="col-sm-8 col-sm-offset-2">
                                        <h2 class="f-m-sizes text-center" style="color:white;">Details for Transaction</h2>
                                        <h5 class="f-m-sizes text-center" style="color:white;">Account Balance Details</h5>
                                        <h4 class="f-m-sizes text-center mb-5" style="color:white;">
                                            @php $balance = $userDetails->getUserBalanceForView($userDetails->unique_id) @endphp
                                            <b>Main Balance: ({{$balance['currency']}}) {{number_format($balance['main'], 2), '.'}}</b>
                                        </h4>
                                        <h4 class="f-m-sizes text-center mb-5" style="color:white;">
                                            @php $balance = $userDetails->getUserBalanceForView($userDetails->unique_id) @endphp
                                            <b>Pending Withdrawal Balance: ({{$balance['currency']}}) {{number_format($balance['withdrawn'], 2), '.'}}</b>
                                        </h4>
                                        <ul class="list-group list-group-unbordered wallet-overview-hold">
                                            <li class="list-group-item">
                                                <b>Amount</b>
                                                @php $amount = $transactionDetails->getAmountForView($transactionDetails->amount) @endphp
                                                <p class="pull-right">{{$balance['currency']}} {{ number_format($amount['data']['amount'], 2)}}</p>
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
        </div>
    </div>

@endsection
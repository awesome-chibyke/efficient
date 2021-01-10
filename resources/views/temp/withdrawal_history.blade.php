@php $pageTitle = 'Funds Withdrawal' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Withdrawal History</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Withdrawal History</li>
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
                        <h4 class="text-danger"><b>Withdrawal History ({{$dates}})</b>  </h4>
                        <div>
                            <form action="{{route('show_withdrawals_transactions_by_date', [auth()->user()->type_of_user !== 'admin' ? auth()->user()->unique_id : ''])}}" method="post">
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
                                        <label for="end_date">From</label>
                                        <input class="form-control" type="date" placeholder="End Date" id="end_date" name="end_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <label></label><br><br>
                                        <button  class="btn btn-info" type="submit">Filter</button>
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
                                    <th class="text-center">Full Name <br> (Email Address)</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Bank Name</th>
                                    <th class="text-center">Account Number</th>
                                    <th class="text-center">Account Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Withdrawal Date</th>

                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @php $transExist = 0; @endphp

                                @if(count($withdrawals) > 0)
                                    @php
                                        $count = 1;
                                    $totalAmount = 0;
                                    @endphp
                                    @foreach($withdrawals  as $k => $eachWithdrawals)
                                        <tr role="row" class="odd">

                                            @php $amountDetails = $eachWithdrawals->getAmountForView($eachWithdrawals->amount) //convert the amount to user currency @endphp
                                            {{--$eachWithdrawals->user_details->account_number.':'.$eachWithdrawals->user_details->bank_code.':'.$amountDetails['data']['amount'].':Lottery Cash Win'.':'.$eachWithdrawals->user_unique_id.':'.$eachWithdrawals->unique_id--}}
                                            <td class="text-center sorting_1">{{$count}}</td>
                                            <td class="text-center sorting_1">{{$eachWithdrawals->user_details->name}} <br>{{$eachWithdrawals->user_details->email}}</td>

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
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>
    </div>

@endsection
<script>
    /* $(document).ready(function () {
         showErrors();
     })*/
</script>

@php $pageTitle = 'Bank details' @endphp

@extends('layouts.design')

@section('content')

<!-- Basic Form area Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-18">Bank details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Bank details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Form row -->
    <div class="row">
        {{--@if(auth()->user()->type_of_user === 'user')--}}

        {{--@endif--}}

        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger"><b>Bank Details</b> <div class="pull-right"> <a href="{{route('main_settings_page')}}" class="btn btn-info guoBtn">Add New Bank Details</a> <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deleteBankDetails(this)" class="btn btn-info guoBtn">Delete Bank Details</a> </div></h4>
                    {{--<div>
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
                    </div>--}}
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th class="text-center">S / N<br><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>
                                <th class="text-center">Bank Name</th>
                                <th class="text-center">Bank Account Number</th>
                                <th class="text-center">Account Name</th>
                                {{--<th class="text-center">Action</th>--}}
                            </tr>
                            </thead>

                            <tbody class="usersHolds">
                            @php $transExist = 0 @endphp
                            @if(count($accountDetails) > 0)

                            @php $count = 1 @endphp
                            @php $totalAmount = 0 @endphp
                            @foreach($accountDetails as $k => $eachAccountDetails)

                            <tr role="row" class="odd">
                                <td class="text-center sorting_1">
                                    <span>{{$count}}</span><br>
                                    <input type="checkbox" class="smallCheckBox" value="{{$eachAccountDetails->unique_id}}">
                                </td>
                                <td class="text-center">{{$eachAccountDetails->bank_name}}</td>
                                <td class="text-center">{{$eachAccountDetails->bank_account_no}}</td>
                                <td class="text-center">{{$eachAccountDetails->account_name}}</td>
                                {{--<td class="text-center">
                                    <a href="{{route('transaction_history',['unique_id'=>$eachAccountDetails->unique_id ])}}">
                                        <button class="btn btn-primary btn-xs">Delete<i class="bx bxs-trash"></i></button>
                                    </a>
                                </td>--}}
                            </tr>
                            @php $count++ @endphp
                            @endforeach
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

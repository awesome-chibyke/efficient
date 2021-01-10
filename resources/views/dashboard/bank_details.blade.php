@php $pageName = 'Settings' @endphp
@php $active = 'settings' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-6">
                                <h2 style="color:white;">Bank Details</h2>
                            </div>

                            <div class="col-sm-6">
                                <div class="pull-right"> <a href="{{route('main_settings_page')}}" class="btn btn-info guoBtn">Add New Bank Details</a> <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deleteBankDetails(this)" class="btn btn-info guoBtn">Delete Bank Details</a> </div>
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

                            <div class="col-sm-12" style="padding-left: 20px; padding-right: 20px;">
                                <table id="myTable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead style="color:white;">
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

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
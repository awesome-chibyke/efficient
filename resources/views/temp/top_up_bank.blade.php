@php $pageTitle = 'Wallet Top Up via Bank' @endphp

@extends('layouts.design')
{{--{{$newTransactionDetails->image_name}} {{die() }}--}}
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Bank Deposit or Transfers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Bank Deposit or Transfers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <i class="fa fa-envelope-o mr-2"></i>
                                        {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @elseif(Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                        <i class="fa fa-envelope-o mr-2"></i>
                                        {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-5">

                                <div class="card rounded box-margin mt-3">
                                    <div class="card-body">
                                        <h4 class="card-title">Amount</h4>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="ml-3">
                                                    @php $amount = $newTransactionDetails->getAmountForView($newTransactionDetails->amount) @endphp
                                                    <h1 class="mb-0">{{number_format($amount['data']['amount'])}} ({{$user->getBalanceForView()['data']['currency']}})</h1>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="profile-thumb-contact text-center">{{--profile--tumb--}}
                                            <h5 class="mt-10">Proof of Payment</h5>
                                            <hr>
                                            @php $link = auth()->user()->returnLink() @endphp
                                            <div style="cursor:pointer;" class="" @if($newTransactionDetails->image_name === null)onclick="bringOutModalMain('.proof-update'); insertTransID('{{$newTransactionDetails->unique_id}}')" @else onclick="viewImage('{{asset($link.'users/transactions/'.$newTransactionDetails->image_name)}}')" @endif title="{{$newTransactionDetails->image_name === null ? 'Click To Upload proof of payment':'Click to view uploaded proof of payment'}}">
                                                @if($newTransactionDetails->image_name === null)
                                                    {{--<img src="{{asset('img/users/transactions/32339.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}">--}}
                                                    <button type="button" class="btn guoBtn">Click here to upload payment proof</button>
                                                @else
                                                    <img src="{{asset($link.'users/transactions/'.$newTransactionDetails->image_name)}}" alt="{{env('APP_NAME', 'LARAVEL')}}">
                                                @endif
                                            </div>
                                            <hr>

                                            <small style="color:#333;">Click the icon located above to upload proof of payment</small>
                                            <hr>
                                            <h5>Status : <span class="label label-{{$newTransactionDetails->status=== 'pending' ? 'warning' : 'info'}}">{{$newTransactionDetails->status}}</span></h5>
                                        </div>
                                    </div>
                                </div>


                            </div> <!-- end col -->
                            <div class="col-lg-7 pl-lg-4">
                                <div class="row">
                                    @if(count($bank_details) > 0)
                                        @foreach($bank_details as $kk => $eachBankDetails)
                                            <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">

                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="profile-thumb-contact text-center">{{--profile--tumb--}}
                                                            <div>
                                                                <h4>Bank details {{$kk + 1}}</h4>
                                                            </div>
                                                            <hr>
                                                            <h5 class="mt-10"><span>Bank Name | </span> <span>{{$eachBankDetails->bank_name}}</span></h5>
                                                            <hr>
                                                            <h5 class="mt-10" style="color:#333;"><span>Account Number |</span> <span>{{$eachBankDetails->bank_account_no}}</span></h5>
                                                            <hr>
                                                            <h5 class="mt-10" style="color:#333;"><span>Account Name | </span> <span>{{$eachBankDetails->account_name}}</span></h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>

                                        @endforeach
                                    @else

                                        <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="profile-thumb-contact text-center">{{--profile--tumb--}}

                                                        <h5 class="mt-10"><span>No Bank Available currently</span></h5>
                                                        <small style="color:#333;">Please Contact system admin for solution to this</small>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    @endif

                                    {{--<div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">Phone Number</div>
                                            <h4 class="ribbon-content">{{($user->phone  === null)?'None':$user->phone }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">State / Region</div>
                                            <h4 class="ribbon-content">{{($user->state  === null)?'None':$user->state }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-danger">Gender</div>
                                            <h4 class="ribbon-content">{{($user->gender  === null)?'None':$user->gender }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-default">Date Of Birth</div>
                                            <h4 class="ribbon-content">{{($user->date_of_birth  === null)?'None':$user->date_of_birth }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">City</div>
                                            <h4 class="ribbon-content">{{($user->city  === null)?'None':$user->city }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">Country</div>
                                            <h4 class="ribbon-content">{{($user->country  === null)?'None':$user->country }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-danger">Address</div>
                                            <p class="ribbon-content">{{($user->address  === null)?'None':$user->address }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-default">Account Name</div>
                                            <h4 class="ribbon-content">{{($user->account_name  === null)?'None':$user->account_name }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper card">
                                            <div class="ribbon ribbon-bookmark  ribbon-default">Account Number</div>
                                            <h4 class="ribbon-content">{{($user->account_number  === null)?'None':$user->account_number }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 height-card box-margin">
                                        <div class="ribbon-wrapper-reverse card">
                                            <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">Bank Name</div>
                                            <h4 class="ribbon-content">{{($user->bank  === null)?'None':$user->bank }}</h4>
                                        </div>
                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->

@endsection
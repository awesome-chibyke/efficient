@php $pageTitle = 'Create Investment' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Edit Investment</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Investment</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>'

        {{--<div class="row">
            <div class="col-lg-12 box-margin">
                <div class="card" style="background: #080E32;">
                    <div class="card-body">

                        @include('dashboard.plans')

                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row">

            <div class="col-lg-12 box-margin">
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
                                <form id="contactForm" method="POST" action="{{ route('update_user_investment', [$investment->unique_id]) }}" class="log-form">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Time Remaining in Days') }} </label>
                                                <input type="text" id="time_remaining_in_days" name="time_remaining_in_days" class="form-control @error('time_remaining_in_days') is-invalid @enderror" placeholder="Amount" value="{{round($investment->time_remaining_in_days)}}"  />
                                                @error('time_remaining_in_days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Date When Investment was created') }} </label>
                                                <input type="text" id="datetimepick" name="created_at" class="form-control @error('created_at') is-invalid @enderror" placeholder="Amount" value="{{$investment->created_at}}"  />
                                                @error('created_at')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group" style="margin-top: 20px;">
                                        <button type="submit" class="btn guoBtn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
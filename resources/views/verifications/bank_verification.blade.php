
@extends('layouts.guest')
@section('content')
    {{--<x-guest-layout  title="{{$title}}">
        <x-jet-authentication-card>
            <x-slot name="logo">
                --}}{{--<x-jet-authentication-card-logo />--}}{{--
            </x-slot>

            <x-jet-validation-errors class="mb-4" />--}}

    <!--  Home Start  -->
    <section id="home" class="page-header  py-6 breadcrumbs" style="background: url({{asset('front/assets/img/bg-page-header.jpg')}}) no-repeat center">
        <div class="home-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Bank Account details</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Home</a>
                            </li>
                            <li class="breadcrumb-item">Add Bank Account details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Home End  -->

    <!--  Contact Start  -->
    <section class="contact contact-02 py-50">
        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-8 pr-md-0 offset-2">
                    <h2 class="main-title text-center">Bank Account Details</h2>
                    <p class="mb-0"></p>
                    <div class="contact-form">
                        <form id="contactForm" method="post" action="{{route('add-bank', ['userId'=>$userDetails->unique_id])}}">
                            @csrf
                            <div style="padding-top: 50px; padding-bottom: 50px;" class="row">

                                <div class="col-lg-12 form-item">
                                    {{--<x-jet-validation-errors class="mb-4 text-danger" />--}}
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6 form-item">
                                    <div class="form-group">
                                        <label>Select Bank</label>
                                        <select id="banks_user" onclick="dropBankName(this)" data-bank-code="{{$userDetails->bank_code}}" name="bank_code" class="form-control bank_code" style="width: 100%">
                                            <option value="" disabled selected>Select your bank</option>
                                        </select>
                                        <input type="hidden" name="bank" value="{{$userDetails->bank}}" class="bank_name" id="bank_name"/>
                                        @error('bank_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-6 form-item">
                                    <div class="form-group">
                                        <label>Account Name</label>
                                        <input type="text" required name="account_name" value="{{$userDetails->account_name}}" id="account_name" class="form-control"  placeholder="Account Name">
                                        @error('account_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 form-item">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input name="account_number" type="text" required value="{{$userDetails->account_number}}" id="account_number" class="form-control"  placeholder="Account number">
                                        @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 text-left pb-4">
                                    <div class="btn-01">
                                        <button type="submit" class="btn" id="submit-btn" >
                                            <span>Submit</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>



    {{--</x-jet-authentication-card>
</x-guest-layout>--}}
@endsection
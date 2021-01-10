
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
                        <h2>Account Verification</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Home</a>
                            </li>
                            <li class="breadcrumb-item">Account Verification Notification</li>
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
                    <h2 class="main-title text-center">Account Verification</h2>
                    <p class="mb-0"></p>
                    <div class="contact-form">
                        <form id="contactForm" method="post" action="{{ route('verification.send') }}">
                            @csrf
                            <div style="" class="row">

                                <div class="col-lg-12 form-item">
                                    {{--<x-jet-validation-errors class="mb-4 text-danger" />--}}
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-white">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        <p>A message containing your account verification link have been sent to your mail box. Please visit your mail box and follow the link to continue. Please click the Resend button below to resend email if you can`t find the already sent one.</p>
                                    </div>
                                </div>



                                <div class="col-sm-12 text-left pb-4">
                                    <div class="btn-01">
                                        <button type="submit" class="btn" id="submit-btn" >
                                            <span>Resend Verification Email</span>
                                            <i class="lni lni-arrow-right"></i>
                                        </button>
                                    </div>

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
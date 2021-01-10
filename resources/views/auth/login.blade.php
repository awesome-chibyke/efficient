
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
                        <h2>Login</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Home</a>
                            </li>
                            <li class="breadcrumb-item">Login</li>
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
                    <h2 class="main-title text-center">Login</h2>
                    <p class="mb-0"></p>
                    <div class="contact-form">
                        <form id="contactForm" method="post" action="{{route('login')}}">
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
                                        <label>Email*</label>
                                        <input name="email" id="email" value="{{old('email')}}" type="email" class="form-control" placeholder="Your email*" >
                                        <input name="refId" value="@if(isset($refId))  {{trim($refId)}} @endif" type="hidden" class="form-control" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 form-item">
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter Password*" >
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 form-item">
                                    <div class="form-group">
                                        <label for="remember">Remember me</label>
                                        <input name="remember" type="checkbox" id="remember" >
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
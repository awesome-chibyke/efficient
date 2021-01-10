
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
                            <h2>Register</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="./">Home</a>
                                </li>
                                <li class="breadcrumb-item">Register</li>
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
                        <h2 class="main-title text-center">Open account its free!</h2>
                        <p class="mb-0"></p>
                        <div class="contact-form">
                            <form id="contactForm" method="post" action="{{route('register')}}">
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
                                            <label>Full Name*</label>
                                            <input name="name" value="{{old('name')}}" id="name" type="text" class="form-control" placeholder="Your First Name*" required >
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input name="email" value="{{old('email')}}"id="email" type="email" class="form-control" placeholder="Your email*" required >
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label for="username">Username*</label>
                                            <input name="username" :value="{{old('username')}}" id="username" type="text" class="form-control" placeholder="Your Last Name*" required >
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input name="phone" id="phone" :value="{{old('phone')}}" type="text" class="form-control" placeholder="Your Phone Number*" required >
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option {{old('gender') === 'male' ? 'selected':''}} value="male">Male</option>
                                                <option {{old('gender') === 'female' ? 'selected':''}} value="female">Female</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item" hidden>
                                        <div class="form-group">
                                            <label>Referral</label>
                                            <input name="referer_unique_id" id="referer_unique_id" type="text" class="form-control" placeholder="Your Phone Number*" value="@if(isset($_GET['ref'])) {{trim($_GET['ref'])}} @endif" >
                                            @error('referer_unique_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label>Password*</label>
                                            <input name="password" id="password" type="password" class="form-control" placeholder="Enter Password*" required >
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-item">
                                        <div class="form-group">
                                            <label>Confirm Password*</label>
                                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Confirm Password*" required >
                                            @error('password_confirmation')
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
                                        {{--<div id="message" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" >
                                            <div class="toast-body d-inline-block"></div>
                                            <button type="button" class="pr-3 close" data-dismiss="toast" aria-label="Close">
                                                Submit
                                            </button>
                                        </div>--}}
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

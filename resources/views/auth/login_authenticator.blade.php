
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
                        <h2>Login Authentication</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Home</a>
                            </li>
                            <li class="breadcrumb-item">Authenticate Login</li>
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

                <div class="col-md-4 pr-md-0 offset-4">
                    <h2 class="main-title text-center">Authenticate Login</h2>
                    <p class="mb-0"></p>
                    <div class="contact-form">
                        <form id="contactForm" method="post" action="{{route('update_login_auth')}}">
                            @csrf
                            <div style="" class="row">

                                <div class="col-lg-12 form-item">
                                    {{--<x-jet-validation-errors class="mb-4 text-danger" />--}}
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                </div>

                                <div class="col-lg-12 form-item">
                                    <div class="form-group">
                                        <label for="code">Login Authentication Code*</label>
                                        <input name="code" id="code" type="text" class="form-control" placeholder="Code" >
                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-12 form-item">
                                    <a style="margin-top: 20px; font-weight: bold;" href="{{route('resend_login_authenticator')}}">Resend Code</a>
                                </div>



                                <div class="col-sm-12 text-left pb-4">
                                    <div class="btn-01">
                                        <button type="submit" class="btn" id="submit-btn" >
                                            <span>Submit</span>
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
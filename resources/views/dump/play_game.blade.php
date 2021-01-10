@php $pageTitle = 'Play Game' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Play Game</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Play Game</li>
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
                                <div class="alert alert-success text-center">
                                    <b>Playing Lucky Lotto (5/90) Direct 1</b>
                                    <br>
                                    Note: you are allowed to play only 1 numbers
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <form id="contactForm" method="POST" action="{{ route('register') }}" class="log-form">
                                                @csrf
                                             <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label for="name">{{ __('Stake Amount:') }}</label>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" id="stake_amount" name="stake_amount" value="{{ old('stake_amount') }}" class="form-control @error('stake_amount') is-invalid @enderror" placeholder="Stake Amount" required data-error="Stake Amount" autofocus>
                                                            @error('stake_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>{{ __('Game Title:') }}</label>
                                                        </td>
                                                        <td class="text-center">Lucky Lotto (5/90) Direct 1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>{{ __('Type Of Lottery:') }}</label>
                                                        </td>
                                                        <td class="text-center">Direct</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label>{{ __('Numbers to Select: :') }}</label>
                                                        </td>
                                                        <td class="text-center">1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="lotto_numbers">{{ __('Numbers to Select: :') }}</label>
                                                        </td>
                                                        <td class="justify-content-center">
                                                            <input type="text" id="lotto_numbers" name="numbers" value="{{ old('numbers') }}" class="form-control @error('numbers') is-invalid @enderror" required data-error="Number to Select" autofocus>
                                                            @error('numbers')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td class="text-center">
                                                            <div class="alert alert-danger">Insufficient Balance</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn guoBtn">Play Game</button>
                                                    </div>
                                                </div><!-- Col -->
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{asset('black_theme/img/dashboard/lottory.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}}">
                                        <h2 class="text-center mt-3">
                                            <b>Countdown Clock </b>
                                        </h2>
                                        <div class="mt-30 row setTimeCountDown">

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div>

@endsection



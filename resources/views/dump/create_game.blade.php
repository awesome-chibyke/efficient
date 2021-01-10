@php $pageTitle = 'Create New Game' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Create New Game</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create New Game</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <img class="img-responsive" src="{{asset('black_theme/img/dashboard/withdrawal.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}}">
                            </div>
                            <div class="col-lg-7">
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
                                <form id="contactForm" method="POST" action="{{ route('createNewGame') }}" class="log-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="title_of_game">{{ __('Game Title') }}</label>
                                                <input type="text" id="title_of_game" name="title_of_game" class="form-control @error('title_of_game') is-invalid @enderror" required data-error="Game Title" placeholder="Game Title" value="{{ old('title_of_game') }}"  />
                                                @error('title_of_game')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Game Type') }}</label>
                                                <select id="type_of_game" name="type_of_game" class="form-control @error('type_of_game') is-invalid @enderror" required data-error="Game Type" >
                                                    <option value="">Please Select</option>
                                                @for($i = 0; $i < count($game_types); $i++)
                                                    <option value="{{$game_types[$i]->unique_id }}">{{$game_types[$i]->type_of_game}}</option>
                                                @endfor
                                                </select>
                                                @error('type_of_game')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="total_numbers">{{ __('Total Number') }}</label>
                                                <input type="number" id="total_numbers" name="total_numbers" class="form-control @error('total_numbers') is-invalid @enderror" required data-error="Total Number" placeholder="Total Number" value="{{ old('total_numbers') }}"  />
                                                @error('total_numbers')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="total_numbers_to_select">{{ __('Total Number to Select') }}</label>
                                                <input type="number" id="total_numbers_to_select" name="total_numbers_to_select" class="form-control @error('total_numbers_to_select') is-invalid @enderror" required data-error="Total Number To Select" placeholder="Total Number To Select" value="{{ old('total_numbers_to_select') }}"  />
                                                @error('total_numbers_to_select')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="total_numbers_for_result">{{ __('Total Number For Result') }}</label>
                                                <input type="number" id="total_numbers_for_result" name="total_numbers_for_result" class="form-control @error('total_numbers_for_result') is-invalid @enderror" required data-error="Total Number For Result" placeholder="Total Number For Result" value="{{ old('total_numbers_for_result') }}"  />
                                                @error('total_numbers_for_result')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="total_number_days_before_draw">{{ __('Total Number Of Days Before Draw ') }}</label>
                                                <input type="number" id="total_number_days_before_draw" name="total_number_days_before_draw" class="form-control @error('total_number_days_before_draw') is-invalid @enderror" required data-error="Total Number Of Days Before Draw" placeholder="Total Number Of Days Before Draw" value="{{ old('total_number_days_before_draw') }}"  />
                                                @error('total_number_days_before_draw')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="lowest_stack_amount">{{ __('Lowest Amount To Stack') }}</label>
                                                <input type="number" id="lowest_stack_amount" name="lowest_stack_amount" class="form-control @error('lowest_stack_amount') is-invalid @enderror" required data-error="Lowest Amount To Stack" placeholder="Lowest Amount To Stack" value="{{ old('lowest_stack_amount') }}"  />
                                                @error('lowest_stack_amount')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="percentage_win">{{ __('Percentage Win') }}</label>
                                                <input type="number" id="percentage_win" name="percentage_win" class="form-control @error('percentage_win') is-invalid @enderror" required data-error="Percentage Win" placeholder="Percentage Win" value="{{ old('percentage_win') }}"  />
                                                @error('percentage_win')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="number_of_correct_correct_games">{{ __('Number Of Correct Games') }}</label>
                                                <input type="number" id="number_of_correct_correct_games" name="number_of_correct_correct_games" class="form-control @error('number_of_correct_correct_games') is-invalid @enderror" required data-error="Number Of Correct Games" placeholder="Number Of Correct Games" value="{{ old('number_of_correct_correct_games') }}"  />
                                                @error('number_of_correct_correct_games')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn guoBtn">Create Game</button>
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
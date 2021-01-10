@php $pageTitle = 'Add New Game' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Add New Game</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Add New Game</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 col-sm-12 box-margin height-card">
                <div class="card">
                    <div class="card-body">
                        <form id="contactForm" method="POST" action="{{ route('create_game_type') }}" class="log-form">
                            @csrf
                            <div class="row">
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="type_of_game">{{ __('Game Type') }}</label>
                                        <select id="type_of_game" name="type_of_game" class="form-control @error('type_of_game') is-invalid @enderror" required data-error="Game Type" >
                                            <option value="">Please Select</option>
                                            @for($i = 0; $i < count($game_titles); $i++)
                                                <option value="{{$game_titles[$i]->unique_id }}">{{$game_titles[$i]->title_of_game}}</option>
                                            @endfor
                                        </select>
                                        @error('type_of_game')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn guoBtn">Add New Game</button>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

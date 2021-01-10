@php $pageTitle = 'Create Gallery' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Create Gallery</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create Gallery</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{--<div class="col-lg-5">
                                <img class="img-responsive" src="{{asset('black_theme/img/dashboard/withdrawal.png')}}" alt="{{env('APP_NAME', 'LARAVEL')}}}">
                            </div>--}}
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
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('store_gallery') }}" class="log-form">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Title') }}</label>
                                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required data-error="Title is required" placeholder=Title" value="{{ old('title') }}"  />
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Description of Event/Gallery') }}</label>
                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description"></textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Add Images Below') }} <small style="color:#333;">Hold down the `ctrl` button on your computer while selecting images, to select multiple images once</small></label>
                                                <input type="file" multiple name="image_file[]" class="form-control @error('description') is-invalid @enderror" placeholder="Description">
                                                @error('image_file.0')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div>
                                                <label for="amount_for_form">{{ __('Add links to videos of this Event already uploaded to YOUTUBE CHANNEL') }} <small style="color:#333;">Url must be of url format: https://example.com or https://wwww.example.com</small></label>
                                                <div class="form-group">
                                                    <input type="text" name="video_url[]" class="form-control @error('description') is-invalid @enderror" placeholder="Video Url Example: https://example.com or https://wwww.example.com">
                                                </div>

                                                <div  class="col-sm-12 video_field_adder" style="margin-bottom: 20px;">
                                                    <button onclick="addNewVideoField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                                </div>

                                                @error('video_url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
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
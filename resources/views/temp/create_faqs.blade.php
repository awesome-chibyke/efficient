@php $pageTitle = 'Create FAQS' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Create Faqs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Create Faqs</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 box-margin">
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
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('store_faqs') }}" class="log-form">
                                    @csrf

                                    <div class="col-12 faqs_fields_holder" data-count-holder="1">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 >1)</h5>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_">Question</label>
                                                    <input type="text" id="question" name="question[]" class="form-control" placeholder="Question"  />
                                                </div>
                                                @error('question.0')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="summernote1">Answer</label>
                                                    <textarea id="summernote1" class="form-control" style="height: auto !important;" name="answers[]" placeholder="Enter Answers To The Question Above Here"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div  class="col-sm-12 faqs_field_adder" style="margin-bottom: 20px;">
                                        <button onclick="addNewFaqsField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn guoBtn btn-block">Submit</button>
                                        </div>
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
@php $pageName = 'Faqs' @endphp
@php $active = 'faqs' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Update News</h2>
                            </div>

                            <div class="col-sm-12">
                                @if(Session::has('success_message'))
                                    <p class="alert alert-success text-center"  role="alert">

                                        {{ Session::get('success_message') }}

                                    </p>
                                @elseif(Session::has('error_message'))
                                    <p class="alert alert-danger text-center text-white" role="alert">

                                        {{ Session::get('error_message') }}

                                    </p>
                                @endif
                            </div>

                            <div class="col-sm-12" >
                                <div class="row">
                                    <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('update_faqs', [$faqs->unique_id]) }}" class="log-form">
                                        @csrf

                                        <div class="col-12 faqs_fields_holder" style="padding-left: 20px; padding-right: 20px;" data-count-holder="1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 >1)</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title_">Question</label>
                                                        <input value="{{$faqs->question}}" type="text" id="question" name="question" class="form-control" placeholder="Question"  />
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
                                                        <textarea id="summernote1" class="form-control" style="height: auto !important;" name="answers" placeholder="Enter Answers To The Question Above Here">{{$faqs->answer}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12" style="padding-left: 10px; padding-right: 10px;">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-info btn-block">Update</button>
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
    </div>

@endsection
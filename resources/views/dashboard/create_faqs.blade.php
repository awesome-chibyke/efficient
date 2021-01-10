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
                                <h2 style="color:white;">Create Faqs</h2>
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

                            <div class="col-sm-12" style="padding-left: 20px; padding-right: 20px;">
                               <div class="row">
                                   <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('store_faqs') }}" class="log-form">
                                       @csrf

                                       <div class="col-12 col-sm-12 faqs_fields_holder" data-count-holder="1">
                                           <div class="row">
                                               <div class="col-12">
                                                   <h5 style="color:white;" >1)</h5>
                                               </div>
                                               <div class="col-12">
                                                   <div class="form-group">
                                                       <label for="title_">Question</label>
                                                       <input type="text" id="question" name="question[]" class="form-control" placeholder="Question"  />
                                                   </div>
                                                   @if($errors->has('question.*'))
                                                       <span class="invalid-feedback" role="alert">
                                                            @foreach($errors->get('question.*') as $message)
                                                               @foreach($message as $error)
                                                                   <strong>{{ $error }}</strong><br>
                                                               @endforeach
                                                           @endforeach
                                                        </span>
                                                   @endif
                                               </div>

                                               <div class="col-12">
                                                   <div class="form-group">
                                                       <label for="summernote1">Answer</label>
                                                       <textarea id="summernote1" class="form-control" style="height: auto !important;" name="answers[]" placeholder="Enter Answers To The Question Above Here"></textarea>
                                                       @if($errors->has('answers.*'))
                                                           <span class="invalid-feedback" role="alert">
                                                            @foreach($errors->get('answers.*') as $message)
                                                                   @foreach($message as $error)
                                                                       <strong>{{ $error }}</strong><br>
                                                                   @endforeach
                                                               @endforeach
                                                        </span>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                       </div>

                                       <div  class="col-sm-12 faqs_field_adder" style="margin-bottom: 20px;">
                                           <button onclick="addNewFaqsField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                       </div>

                                       <div class="col-12">
                                           <div class="form-group">
                                               <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
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
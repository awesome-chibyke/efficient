@php $pageTitle = 'Create Support' @endphp

@extends('layouts.design')

@section('content')

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-18">Create Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                                <li class="breadcrumb-item active">Create Support</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <!-- Email Area -->
                            <div class="compose-email--area">
                                <div class="d-sm-flex">
                                    <div class="mail-side-menu mb-30">
                                        <div class="ibox-content mailbox-content">
                                            <div class="file-manager clearfix">
                                                {{--<a class="btn btn-primary d-block" href="compose-mail.html">Compose</a>--}}
                                                <!-- Title -->
                                                {{--<div class="folder-title mt-50">
                                                    <h6 class="mb-3 primary-color-text">Message</h6>
                                                </div>
                                                <ul class="folder-list">
                                                    @if(count($support) > 0)
                                                        @foreach($support as $singleSupport)
                                                    <li class="active"><a href="{{route('view_single_support', [$singleSupport->unique_id])}}"> <i class="ti-email"></i> {{$singleSupport->title_}} <span class="badge badge-pill badge-primary inbox ml-2">{{$singleSupport->getUnreadCount($singleSupport->unique_id)}}</span> </a></li>
                                                        @endforeach
                                                    @else
                                                    <li><a href="javascript:;"> <i class="ti-power-off text-danger"></i> No Message Available</a></li>
                                                    @endif

                                                </ul>--}}

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Box Header -->
                                    <div class="mail-body--area">
                                        <div class="box box-primary">
                                            <form method="post" enctype="multipart/form-data" action="{{route('store_support')}}">
                                                @csrf
                                                <div class="box-header with-border compose">
                                                    @php $AppsSettings = new \App\Models\AppSettings() @endphp
                                                    @php $Settings = $AppsSettings->getSingleModel() @endphp
                                                    <h5 class="mb-30">Send a message to {{$Settings->site_name}} support</h5>
                                                </div>
                                                <!-- Box-header -->
                                                <div class="box-body">

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
                                                    <div class="form-group mb-30">
                                                        <input name="title_" value="{{old('title_')}}" type="text" class="form-control" placeholder="Subject:">
                                                        @error('title_')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="message"  id="" class="form-control" placeholder="Your Message Here ...">{{old('message')}}</textarea>
                                                        @error('message')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" value="{{auth()->user()->unique_id}}" name="sender_id">
                                                    <input type="hidden" name="receiver_id">
                                                    <style>
                                                        .note-editor{
                                                            border-color: black !important;
                                                        }
                                                    </style>
                                                    <div class="form-group">
                                                        <label style="color:#333">Upload an Image File (Optional)</label><br>
                                                        <div class="btn btn-orange btn-file compo-email" style="border-color:black;">
                                                            <i class="fa fa-paperclip font-16 mb-"></i>
                                                            <input multiple type="file" name="file_name[]">
                                                        </div>
                                                        <p class="text-dark" style="color:black;">Max. 40MB</p>
                                                        @error('file_name.0')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        @error('file_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                                <!-- Box-body -->
                                                <div class="box-footer">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-envelope-o"></i> Send</button>
                                                        {{--<button type="button" class="btn btn-primary mb-2"><i class="fa fa-pencil"></i> Draft</button>
                                                        <button type="reset" class="btn btn-primary mb-2"><i class="fa fa-times"></i> Discard</button>--}}
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
        </div>

        <!-- Footer Area -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Footer Area -->
                    <footer class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p class="font-13">Created by @<a href="#">Theme-zome.</a></p>
                        </div>
                        <div class="fotter-icon text-center">
                            <p class="mb-0 font-13">2020 @ Metrozi. </p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

@endsection


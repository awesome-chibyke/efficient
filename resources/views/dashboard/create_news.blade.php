@php $pageName = 'News' @endphp
@php $active = 'news' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">Create News</h2>
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

                            <div class="col-sm-12" style="padding: 10px;">
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('store_news') }}" class="log-form">
                                    @csrf

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title_">News Title</label>
                                            <input type="text" id="title_" name="title_" class="form-control"  />
                                        </div>
                                        @error('title_')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">Display Image</label>
                                            <input type="file" id="image_name" class="form-control" name="image_name" >
                                            @error('image_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12" hidden>
                                        <div class="form-group">
                                            <label for="title_">Tags</label>
                                            <input type="text" class="form-control" value="" style="color:black !important;"  data-role="tagsinput" name="tags" />
                                            {{--<input type="text" id="title_" name="title" class="form-control"  />--}}
                                        </div>
                                        @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="summernote">News Body</label>
                                            <textarea id="summernote" class="form-control" name="news" placeholder="Enter News Here">{{old('news')}}</textarea>
                                            @error('news')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-block btn-lg">Submit News</button>
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
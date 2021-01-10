@php $pageName = 'Gallery' @endphp
@php $active = 'gallery' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <form method="post" action="{{ route('store_gallery') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

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

                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 style="color:white;">Add New Event to Gallery</h3>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="widget-text-box">
                                                <h4>Title</h4>
                                                <div class="form-select-list">
                                                    <input type="text" placeholder="Title" name="title" class="form-control" value="{{old('title')}}" >
                                                    @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="widget-text-box">
                                                <h4>Description of Event</h4>
                                                <div class="form-select-list">
                                                    <textarea class="form-control" placeholder="Description" name="description">{{old('description')}}</textarea>
                                                    @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="widget-text-box">
                                                <h4>Add Images Below <small style="color:#ddd;">Hold down the `ctrl` button on your computer while selecting images, to select multiple images once</small></h4>
                                                <div class="form-select-list">
                                                    <input name="image_file[]" multiple type="file" class="form-control"  />
                                                    @if($errors->has('image_file.*'))
                                                        <span class="invalid-feedback" role="alert">
                                                            @foreach($errors->get('image_file.*') as $message)
                                                                @foreach($message as $error)
                                                                    <strong>{{ $error }}</strong><br>
                                                                @endforeach
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-12" style="margin-top: 30px;">
                                            <hr style="color:#ddd;">
                                            <h4 style="color: #fff;">Add links to videos of this Event already uploaded to YOUTUBE CHANNEL <br><small style="color: #ddd;">Url must be of url format: https://example.com or https://wwww.example.com</small></h4>
                                        </div>
                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="widget-text-box">
                                                        <div class="form-select-list">
                                                            <input type="text" name="video_url[]" class="form-control" placeholder="Video Url Example: https://example.com or https://wwww.example.com">
                                                            @if($errors->has('video_url.*'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    @foreach($errors->get('video_url.*') as $message)
                                                                        @foreach($message as $error)
                                                                            <strong>{{ $error }}</strong><br>
                                                                        @endforeach
                                                                    @endforeach
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 video_field_adder" style="margin-bottom: 10px; margin-top: 20px;">
                                                    <button onclick="addNewVideoField()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-12" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-success btn-lg btn-block">Add Event to Gallery</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
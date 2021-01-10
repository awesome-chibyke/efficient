@php $pageName = 'Gallery' @endphp
@php $active = 'gallery' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">





                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-12">
                                <h2 style="color:white;">{{$gallery->title}}</h2>
                            </div>
                            <div class="col-sm-12">
                                <p class="col-sm-12" style="color:white;">{{$gallery->description}}</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="pull-right col-sm-12" style="margin-bottom:20px;">  <a title="Please select the images or video you ant to delete, then click this button to delete" href="javascript:;" onclick="confirmDeleteOfGalleryImages(this)" class="btn btn-info guoBtn">Delete Selected Images</a> </div>
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
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('update_gallery', [$gallery->unique_id]) }}" class="log-form">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="type_of_game">{{ __('Title') }}</label>
                                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required data-error="Title is required" placeholder=Title" value="{{ $gallery->title }}"  />
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
                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{$gallery->description}}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="amount_for_form">{{ __('Add Images Below') }} <small style="color:#fff;">Hold the control your computer while selecting images, to select multiple images once. Newly added images will added to the already existing images. You can delete images from the view gallery area</small></label>
                                                <input type="file" multiple name="image_file[]" class="form-control @error('image_file') is-invalid @enderror" placeholder="Description">
                                                <input type="hidden" name="unique_id" value="{{$gallery->unique_id}}">
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

                                        <div class="col-lg-12 col-md-12">
                                            <div>
                                                <label for="amount_for_form">{{ __('Add links to videos of this Event already uploaded to YOUTUBE CHANNEL') }} <small style="color:#fff;">Url must be of url format: https://example.com or https://wwww.example.com. Newly added Video Links will added to the already existing video links. You can delete video from the view gallery area</small></label>
                                                <div class="form-group">
                                                    <input type="text" name="video_url[]" class="form-control @error('description') is-invalid @enderror" placeholder="Video Url Example: https://example.com or https://wwww.example.com" />
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

                                                <div  class="col-sm-12 video_field_adder" style="margin-bottom: 20px;">
                                                    <button onclick="addNewVideoFieldForEdit()" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-plus-circle"></i></button>
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
                                        <button type="submit" class="btn guoBtn">Update</button>
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
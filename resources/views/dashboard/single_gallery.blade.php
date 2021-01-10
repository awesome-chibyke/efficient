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
                                <div class="row">

                                    @php $galleryMedia = $gallery->galleryMedia @endphp
                                    @if(count($galleryMedia) > 0)
                                        @php $link = auth()->user()->returnLink(); @endphp
                                        @foreach($galleryMedia as $k => $eachMedia)
                                            @if($eachMedia->media_type === 'image')
                                                @php $image = asset($link.'gallery/'.$eachMedia->media); @endphp
                                                <div class="col-sm-3" style="position: relative;">
                                                    <div style="position:absolute; top: 0px;">
                                                        <input type="checkbox" value="{{$eachMedia->unique_id}}" class="smallCheckBox" />
                                                    </div>
                                                    <a href="{{$image}}" title="Click to view a larger size of the image" data-lightbox="roadtrip"><img src="{{$image}}" class="img-fluid mb-30" alt=""> </a>
                                                </div>
                                            @endif

                                            @if($eachMedia->media_type === 'video')
                                                <div class="col-sm-3 " style="position: relative;">
                                                    <div style="position:absolute; top: 0px;">
                                                        <input type="checkbox" value="{{$eachMedia->unique_id}}" class="smallCheckBox" />
                                                    </div>
                                                    {{--<a href="{{$image}}" title="Click to view a larger size of the image" data-lightbox="roadtrip"><img src="{{$image}}" class="img-fluid mb-30" alt=""></a>--}}
                                                    <iframe width="100%" height="" src="{{ $eachMedia->buildEmbededLink($eachMedia->media) }}" frameborder="0" allow="autoplay; encrypted-media"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                </div>
                                            @endif

                                        @endforeach
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
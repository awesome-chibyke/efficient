@php $pageTitle = 'Single Gallery' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">{{$gallery->title}}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">{{$gallery->title}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            {{--@if(auth()->user()->type_of_user === 'user')--}}

            {{--@endif--}}

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title text-danger col-sm-12"><b>{{$gallery->title}}</b></h4>
                            <p class="col-sm-12">{{$gallery->description}}</p> <div class="pull-right col-sm-12" style="margin-bottom:20px;">  <a title="Please select the images or video you ant to delete, then click this button to delete" href="javascript:;" onclick="confirmDeleteOfGalleryImages(this)" class="btn btn-info guoBtn">Delete Selected Images</a> </div>
                        </div>
                        {{--<div>
                            <form action="{{route('show_investments_by_date', [$investmentSettings->unique_id])}}" method="post">
                                @csrf
                                <h5>Filter With Date</h5>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <input type="date" class="form-control" placeholder="Start Date" name="start_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <input class="form-control" type="date" placeholder="End Date" name="end_date" >
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group  col-sm-4">
                                        <button  class="btn btn-info" type="submit">Go</button>
                                    </div>
                                    <hr style="color: #fff;" size="10">
                                </div>
                            </form>
                        </div>--}}
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

                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
        </div>
        <style>
            th, td{
                font-size: 12px !important;
            }
        </style>

@endsection

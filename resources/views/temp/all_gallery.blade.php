@php $pageTitle = 'All Galleries' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">All Gallery</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">All Gallery</li>
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
                        <h4 class="text-danger"><b>All Gallery</b> <div class="pull-right">  <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmGalleryDelete(this)" class="btn btn-info guoBtn">Delete Selected Galleries</a> </div></h4>
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
                            @if(count($gallery) > 0)
                                @foreach($gallery as $k => $eachGallery)
                                    <div class="col-sm-6 col-xl-3" style="position:relative;">
                                        <div class="single-gallery--item mb-50">
                                            <div class="gallery-thumb" >
                                                @php $firstMedia = $eachGallery->galleryMedia[0]->media; @endphp
                                                {{--@php $image = asset('storage/public/img/users/transactions/'.$firstMedia); @endphp--}}
                                                @php $link = auth()->user()->returnLink(); @endphp
                                                @php $image = asset($link.'gallery/'.$firstMedia); @endphp
                                                <img src="{{$image}}" alt="">
                                                <div style="position:absolute; top: 20px;">
                                                    <input type="checkbox" class="smallCheckBox" value="{{$eachGallery->unique_id}}" />
                                                </div>
                                            </div>
                                            <div class="gallery-text-area">
                                                <h6 class="text-white font-16 mb-0">{{$eachGallery->title}}</h6>
                                                <p class="text-white mb-10">{{$eachGallery->description}}</p>

                                                <div class="gallery-icon">
                                                    <a href="javascript:;" style="font-size: 11px;">{{$eachGallery->created_at}}</a>
                                                    {{--<a href="#"><i class="zmdi zmdi-comment-more"></i></a>
                                                    <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                                    <a href="#"><i class="zmdi zmdi-crop-free"></i></a>--}}
                                                </div>
                                                <a title="View Pictures and Images in this gallery" class="btn guoBtn" href="{{route('view_single_gallery', [$eachGallery->unique_id])}}" style="color:white;">View More</a>
                                                <a title="Edit Gallery" class="btn guoBtn" href="{{route('edit_gallery_page', [$eachGallery->unique_id])}}" style="color:white;"><i class="fa fa-pencil"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-12 col-xl-12 text-center">
                                    <p class="alert alert-danger">No Data Available</p>
                                </div>
                            @endif


                    </div> <!-- end card body-->
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

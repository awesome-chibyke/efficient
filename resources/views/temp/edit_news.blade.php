@php $pageTitle = 'Edit News' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Edit News</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit News</li>
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
                                <form id="contactForm" enctype="multipart/form-data" method="POST" action="{{ route('update_news', [$singleNews->unique_id]) }}" class="log-form">
                                    @csrf

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title_">News Title</label>
                                            <input type="text" id="title_" name="title_" value="{{$singleNews->title}}" class="form-control"  />
                                        </div>
                                        @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">Display Image <small>Image uploaded will overwrite the existing image</small></label>
                                            <input type="file" id="image_name" class="form-control" name="image_name" >
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12" style="margin-bottom: 20px;">
                                        <div class="row" style="border: 2px solid #080E32;">
                                            {{--<div >--}}
                                                <div class="col-sm-12">
                                                    <p class="alert alert-info" style="font-size: 1rem; color:black;">please thick the check box bearing the tag you will like to delete from the already existing tag list</p>
                                                </div>
                                                @php $newTags = $singleNews->NewsTagDetails2($singleNews->unique_id) @endphp
                                                @if(count($newTags) > 0)
                                                    @foreach($newTags as $k => $eachTag)
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="delete_tags">
                                                                    {{$eachTag->tag}}
                                                                    <input type="checkbox" id="delete_tags{{$k}}" class="form-control" value="{{$eachTag->unique_id}}" name="delete_tags[]" />
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                           {{-- </div>--}}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title_">News Tags</label>
                                            <input type="text" style="color:black !important;" class="form-control" data-role="tagsinput" name="tags" />
                                            {{--<input type="text" id="title_" name="title" class="form-control"  />--}}
                                        </div>
                                        @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="summernote">News Body</label>
                                            <textarea id="summernote" class="form-control" name="news" placeholder="Enter News Here">{{$singleNews->news}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn guoBtn btn-block">Update News</button>
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
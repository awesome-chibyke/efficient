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

                                    <div class="col-12 col-sm-12" style="margin-bottom: 20px;" hidden>
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

                                    <div class="col-12" hidden>
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
                                            <button type="submit" class="btn btn-lg btn-info btn-block">Update News</button>
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
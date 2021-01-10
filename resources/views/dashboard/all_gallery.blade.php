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

                            <div class="col-sm-6">
                                <h2 style="color:white;">Gallery</h2>
                            </div>
                            <div class="col-sm-6" style="margin-top: 10px;">
                                @if(auth()->user()->privilegeChecker('delete_gallery'))
                                <div class="pull-right">
                                    <a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="confirmGalleryDelete(this)" class="btn btn-info guoBtn">Delete Selected Galleries</a>
                                </div>
                                @endif
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
                                    <div class="col-sm-12" style="margin-top: 10px; ">
                                        <div class="table-responsive" >
                                            <table id="myTable" class="table table-striped ">
                                                <thead style="color:white;">
                                                <tr>
                                                    <th class="text-center">S / N</th>
                                                    @if(auth()->user()->type_of_user !== 'user')
                                                        <th class="text-center">
                                                            <input onclick="checkAll()" type="checkbox" class="mainCheckBox"  />
                                                        </th>
                                                    @endif
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Description</th>
                                                    <th class="text-center">Main Image</th>
                                                    <th class="text-center">Date Created</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody class="usersHolds" style="color:black;">
                                                @php $transExist = 0 @endphp
                                                @if(count($gallery) > 0)

                                                    @php $count = 1 @endphp
                                                    @php $totalAmount = 0 @endphp
                                                    @foreach($gallery as $k => $eachGallery)

                                                        <tr role="row" class="odd">
                                                            <td class="text-center sorting_1">
                                                                <span>{{$count}}</span><br>
                                                            </td>

                                                            @if(auth()->user()->type_of_user !== 'user')
                                                                <td class="text-center sorting_1">
                                                                    <input type="checkbox" class="smallCheckBox" value="{{$eachGallery->unique_id}}">
                                                                </td>
                                                            @endif

                                                            <td class="text-center">{{$eachGallery->title}}</td>
                                                            <td class="text-center">{{$eachGallery->description}}</td>

                                                            @php $firstMedia = $eachGallery->galleryMedia[0]->media; @endphp
                                                            {{--@php $image = asset('storage/public/img/users/transactions/'.$firstMedia); @endphp--}}
                                                            @php $link = auth()->user()->returnLink(); @endphp
                                                            @php $image = asset($link.'gallery/'.$firstMedia); @endphp

                                                            <td class="text-center">
                                                                <div style="width: 80px;" >
                                                                    <img src="{{$image}}" style="width: 100%;" />
                                                                </div>
                                                            </td>
                                                            <td class="text-center">{{$eachGallery->created_at}}</td>

                                                            <td class="text-center">

                                                                <div class="btn-group">
                                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Options</button>

                                                                    <!--view user details-->
                                                                    <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">

                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('view_single_gallery', [$eachGallery->unique_id])}}">View Details</a></button>
                                                                        <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('edit_gallery_page', [$eachGallery->unique_id])}}">Edit</a></button>

                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
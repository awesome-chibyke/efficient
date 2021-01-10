@php $pageName = 'Testimonies' @endphp
@php $active = 'testimony' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">





                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-6">
                                <h2 style="color:white;">All Testimonies</h2>
                            </div>
                            <div class="col-sm-6" style="margin-top: 10px;">
                                @if(auth()->user()->privilegeChecker('delete_gallery'))
                                    <div class="pull-right">
                                        <button title="Please tick the Testimonies you want to approve and click this button to proceed" onclick="approveTestimonies(this)" class="btn btn-info guoBtn">Approve Selected Testimonies</button>
                                        <button type="button" title="Please tick the Testimonies you want to delete and click this button to proceed" type="button" onclick="confirmDeleteTestimonies(this)" class="btn btn-info guoBtn">Delete Selected Testimonies</button>
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
                                            <table id="datatable-buttons" class="table table-condensed table-striped table-condensed dt-responsive nowrap w-100">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">S / N</th>
                                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>

                                                    <th class="text-center">Full Name of User</th>
                                                    <th class="text-center">Testimony</th>
                                                    <th class="text-center">Video Link</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Date Created </th>
                                                </tr>
                                                </thead>

                                                <tbody class="usersHolds">
                                                @if(count($testimonies) > 0)

                                                    @php $count = 1 @endphp
                                                    @php $totalAmount = 0 @endphp

                                                    @foreach($testimonies as $k => $eachTestimonyObj)

                                                        <tr role="row" class="odd">
                                                            <td class="text-center sorting_1">
                                                                <span>{{$count}}</span>
                                                            </td>

                                                            <td class="text-center sorting_1">
                                                                <input type="checkbox" class="smallCheckBox" value="{{$eachTestimonyObj->unique_id}}">
                                                            </td>

                                                            <td class="text-center">{{$eachTestimonyObj->user_unique_id === '' ? 'Admin': $eachTestimonyObj->userDetails->name}}</td>
                                                            <td class="text-center">{{ $eachTestimonyObj->testimony }}</td>
                                                            <td class="text-center">
                                                                @if($eachTestimonyObj->video_link !== null)
                                                                    <button type="button" class="btn guoBtn" onclick="playTestimony('{{$eachTestimonyObj->video_link}}')">Play Video</button>
                                                                @else
                                                                    {{'No Video'}}
                                                                @endif
                                                            </td>
                                                            <td class="text-center"><span class="label label-{{$eachTestimonyObj->returnTestimonyStatus($eachTestimonyObj->status)}}">{{$eachTestimonyObj->status}}</span></td>
                                                            <td class="text-center">{{$eachTestimonyObj->created_at}}</td>

                                                        </tr>
                                                        @php $count++ @endphp
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
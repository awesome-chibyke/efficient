@php $pageTitle = 'All Testimonies' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Testimonies</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Testimonies</li>
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
                        <h4 class="text-danger"><b>Testimonies</b> <div class="pull-right">  <button title="Please tick the Testimonies you want to approve and click this button to proceed" onclick="approveTestimonies(this)" class="btn btn-info guoBtn">Approve Selected Testimonies</button> <button type="button" title="Please tick the Testimonies you want to delete and click this button to proceed" type="button" onclick="confirmDeleteTestimonies(this)" class="btn btn-info guoBtn">Delete Selected Testimonies</button> </div> </h4>

                        <div class="table-responsive">
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

@php $pageTitle = 'All News' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Centers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Centers</li>
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
                        <h4 class="text-danger"><b>Centers</b> <div class="pull-right">  <a title="Please click the news you want to delete and click this button to proceed" href="javascript:;" onclick="confirmDeleteCenter(this)" class="btn btn-info guoBtn">Delete Selected Centers</a> </div> </h4>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-condensed table-striped table-condensed dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>

                                    <th class="text-center">Team</th>
                                    <th class="text-center">Phone 1/Phone 2</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">City/Town</th>
                                    <th class="text-center">State/Province/Region</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Bank Name <br> Bank Account Number <br> Bank Account Name</th>
                                    <th class="text-center">Date Created </th>
                                    <th class="text-center">Options </th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @if(count($collectionCenters) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp

                                    @foreach($collectionCenters as $k => $eachCenter)

                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <span>{{$count}}</span>
                                            </td>
                                            <td class="text-center sorting_1">
                                                <input type="checkbox" class="smallCheckBox" value="{{$eachCenter->unique_id}}">
                                            </td>
                                            <td class="text-center">{{$eachCenter->team}}</td>
                                            <td class="text-center">{{$eachCenter->phone1}}<br>{{$eachCenter->phone2}}</td>
                                            <td class="text-center">{{$eachCenter->address}}</td>
                                            <td class="text-center">{{$eachCenter->city_town}}</td>
                                            <td class="text-center">{{$eachCenter->state_region_province}} </td>
                                            <td class="text-center">{{$eachCenter->country}} </td>
                                            <td class="text-center">{{$eachCenter->bank_name}} <br> {{$eachCenter->bank_account_no}} <br> {{$eachCenter->account_name}}</td>
                                            <td class="text-center">{{$eachCenter->created_at}}</td>
                                            <td class="text-center">
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('edit_center_page', [$eachCenter->unique_id])}}" >Edit Center</a>

                                                    </div>
                                                </div>
                                            </td>

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

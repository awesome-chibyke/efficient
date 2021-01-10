@php $pageTitle = 'All News' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">List of All News</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">List of All News</li>
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
                        <h4 class="text-danger"><b>List of All News</b> <div class="pull-right">  <a title="Please click the news you want to delete and click this button to proceed" href="javascript:;" onclick="confirmDeleteNews(this)" class="btn btn-info guoBtn">Delete News</a> </div> </h4>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-condensed table-striped table-condensed dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>

                                    <th class="text-center">News Title</th>
                                    <th class="text-center">News Tags</th>
                                    <th class="text-center">Display Image</th>
                                    <th class="text-center">Date Created </th>
                                    <th class="text-center">Options </th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @if(count($news) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp

                                    @foreach($news as $k => $eachNews)

                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <span>{{$count}}</span>
                                            </td>

                                            <td class="text-center sorting_1">
                                                <input type="checkbox" class="smallCheckBox" value="{{$eachNews->unique_id}}">
                                            </td>

                                            <td class="text-center">{{$eachNews->title}}</td>
                                            <td class="text-center">
                                                @php $newsTags = $eachNews->NewsTagDetails2($eachNews->unique_id); @endphp
                                                @php

                                                    $tags = '';
                                                    if(count($newsTags) > 0){

                                                        foreach ($newsTags as $k => $eachTag){
                                                            $tags .= "<span style='color:white;' class='label label-primary'>".$eachTag->tag."</span>";
                                                        }
                                                    }
                                                @endphp
                                                @php echo $tags; @endphp
                                            </td>

                                            <td class="text-center">
                                                <div style="width: 80px;">
                                                    @php $link = auth()->user()->returnLink(); @endphp
                                                    <img src="{{asset($link.'news_image/'.$eachNews->image_name)}}"  />
                                                </div>
                                            </td>
                                            <td class="text-center">{{$eachNews->created_at}}</td>
                                            <td class="text-center">
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('edit_news_page', [$eachNews->unique_id])}}" >Edit News</a>
                                                        <a class="dropdown-item" href="{{route('single_news_page', [$eachNews->unique_id])}}" >View</a>
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

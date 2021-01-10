@php $pageTitle = 'All News' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">List of Faqs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">List of Faqs</li>
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
                        <h4 class="text-danger"><b>Faqs</b> <div class="pull-right">  <a title="Please tick the FAQS you want to delete and click this button to proceed" href="javascript:;" onclick="confirmDeleteFaqs(this)" class="btn btn-info guoBtn">Delete Selected Faq(s)</a> </div> </h4>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-condensed table-striped table-condensed dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center"><input onclick="checkAll()" type="checkbox" class="mainCheckBox"  /></th>

                                    <th class="text-center">Question</th>
                                    <th class="text-center">Answer</th>
                                    <th class="text-center">Date Created </th>
                                    <th class="text-center">Options </th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                @if(count($faqs) > 0)

                                    @php $count = 1 @endphp
                                    @php $totalAmount = 0 @endphp

                                    @foreach($faqs as $k => $eachFaq)

                                        <tr role="row" class="odd">
                                            <td class="text-center sorting_1">
                                                <span>{{$count}}</span>
                                            </td>

                                            <td class="text-center sorting_1">
                                                <input type="checkbox" class="smallCheckBox" value="{{$eachFaq->unique_id}}" />
                                            </td>

                                            <td class="text-center">{{$eachFaq->question}}</td>
                                            <td class="text-center">{{ $eachFaq->answer }}</td>
                                            <td class="text-center">{{$eachFaq->created_at}}</td>
                                            <td class="text-center">
                                                <div class="btn-group mb-2">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Action</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('edit_faqs', [$eachFaq->unique_id])}}" >Edit Faqs</a>
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

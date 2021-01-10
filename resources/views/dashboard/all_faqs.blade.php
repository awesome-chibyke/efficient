@php $pageName = 'Faqs' @endphp
@php $active = 'faqs' @endphp
@extends('layouts.man_dash')

@section('content')

    <div class="author-area-pro">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="author-widgets-single res-mg-t-30">

                        <div class="row">

                            <div class="col-sm-6">
                                <h2 style="color:white;">All Faqs</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">  <a title="Please tick the FAQS you want to delete and click this button to proceed" href="javascript:;" onclick="confirmDeleteFaqs(this)" class="btn btn-info guoBtn">Delete Selected Faq(s)</a> </div>
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

                            <div class="col-sm-12" style="padding-left: 20px; padding-right: 20px;">
                                <table id="myTable" class="table table-condensed table-striped table-condensed dt-responsive nowrap w-100">
                                    <thead style="color:white;">
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

                                                    <div class="btn-group">
                                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Options</button>

                                                        <!--view user details-->
                                                        <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">

                                                            <button type="button" tabindex="0" class=" btn btn-block"><a href="{{route('edit_faqs', [$eachFaq->unique_id])}}">Edit Faqs</a></button>

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

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
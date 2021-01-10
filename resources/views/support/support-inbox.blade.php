@php $pageTitle = 'Support' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-18">Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Support</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inbox-area">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="d-sm-flex">
                                    <div class="mail-side-menu mb-30">
                                        <div class="ibox-content mailbox-content">
                                            <div class="file-manager clearfix">
                                                @if(auth()->user()->type_of_user === 'user')
                                                <a class="btn btn-primary d-block" href="{{route('create_support', auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id : '')}}">Create New Support Message</a>
                                                @endif
                                                <!-- Title -->
                                                {{--<div class="folder-title mt-50">
                                                    <h6 class="mb-3 primary-color-text">Messages</h6>
                                                </div>
                                                <ul class="folder-list">
                                                    @if(count($support) > 0)
                                                        @foreach($support as $singleSupport)
                                                            <li class="active"><a href="{{route('view_single_support', [$singleSupport->unique_id])}}"> <i class="ti-email"></i> {{$singleSupport->title}} <span class="badge badge-pill badge-primary inbox ml-2">{{$singleSupport->getUnreadCount($singleSupport->unique_id)}}</span> </a></li>
                                                        @endforeach
                                                    @else
                                                        <li><a href="javascript:;"> <i class="ti-power-off text-danger"></i> No Message Available</a></li>
                                                    @endif
                                                </ul>--}}

                                                {{--<div class="categori-title mt-30">
                                                    <h6 class="mb-3 primary-color-text">Labels</h6>
                                                </div>

                                                <ul class="category-list">
                                                    <li><a href="#"> <i class="fa fa-circle text-navy"></i> Clients</a></li>
                                                    <li><a href="#"> <i class="fa fa-circle text-danger"></i> Important</a></li>
                                                    <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                                                    <li><a href="#"> <i class="fa fa-circle text-info"></i> Other</a></li>
                                                </ul>--}}
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mail-body--area">
                                        <div class="mail-box-header" >
                                            <div class="mail-title-search-area d-md-flex align-items-center justify-content-between">
                                                <!-- Title -->
                                                <div class="inbox-title mb-15">
                                                    <h2>Support Messages</h2>
                                                </div>
                                                <div class="search-wrapper mb-15">
                                                    <form action="#" method="get">
                                                        <input type="search" name="search" class="form-control mb-0 inbox-mail" placeholder="Search...">
                                                        <button type="submit" class="d-none"></button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Tools -->
                                            <div class="mail-tools tooltip-demo d-flex align-items-center mb-15 justify-content-between">
                                                <div class="mail-btn-group d-flex align-items-center mb-15">
                                                    <a href="javascript:;" onclick="deleteSupport(this)" class="btn"><i class='bx bx-trash'></i></a>
                                                    <a href="javascript:;" class="btn"><input onclick="checkAll()" type="checkbox" class="mainCheckBox" title="Select All" /></a>
                                                    {{--<a href="#" class="btn"><i class='bx bx-folder-open'></i></a>
                                                    <a href="#" class="btn"><i class='bx bx-purchase-tag-alt' ></i></a>
                                                    <a href="#" class="btn"><i class="ti-settings"></i></a>--}}
                                                </div>
                                                <div class="mail-pager d-flex align-items-center text-right mb-15">
                                                    {{--<span>( 1-50 of 90 )</span>
                                                    <a href="#"><i class="arrow_carrot-left"></i></a>
                                                    <a href="#"><i class="arrow_carrot-right"></i></a>--}}
                                                    {{$support->links()}}
                                                </div>
                                                <style>
                                                    .vertical-dark .border {
                                                        border: 0px solid black !important;
                                                        box-shadow: 0px 0px 2px #999;
                                                        font-size: 14px !important;
                                                        color: #333;
                                                    }

                                                    .vertical-dark:hover .border {
                                                        color: #333 !important;
                                                    }
                                                    .mail-pager > nav >  div > span{
                                                        background: #dddddd !important;
                                                    }
                                                </style>
                                            </div>
                                        </div>

                                        <div class="admi-mail-list mb-30">
                                            <!-- Single Mail -->
                                            @if(count($support) > 0)
                                                @foreach($support as $singleSupport)
                                            <div class="admi-mail-item">

                                                <input type="checkbox" value="{{$singleSupport->unique_id}}" class="smallCheckBox" />
                                                <!-- Admi-mail-star -->

                                                <a href="{{route('view_single_support', [$singleSupport->unique_id])}}">
                                                    <!-- Admi-mail-body -->
                                                    <div class="admi-mail-body d-flex align-items-center mr-3">
                                                        <div class="mail-thumb flex-40-thubm mr-3">
                                                            <img class="border-radius-50" src="img/member-img/1.png" alt="">
                                                        </div>
                                                        <div class="div">
                                                            <div class="admi-mail-from">SENT BY {{$singleSupport->SenderDetails->name}}</div>
                                                            <div class="admi-mail-subject">
                                                                <p class="mb-0 mail-subject--text--" style="color:#fff;">{{$singleSupport->title_}}  <sup class="badge badge-dark">{{$singleSupport->getUnreadCount($singleSupport->unique_id)}}</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="admi-mail-date">{{$singleSupport->created_at->diffForHumans()}}</div>
                                            </div>
                                                @endforeach
                                            @else
                                                <div class="admi-mail-item text-center">

                                                    <p class="alert alert-info">No Data Available</p>
                                                </div>
                                            @endif
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


@php $pageTitle = 'Support' @endphp

@extends('layouts.design')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Single Message</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Single Message</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <!-- Email Area -->
                        <div class="d-sm-flex">
                            <div class="mail-side-menu mb-30">
                                <div class="ibox-content mailbox-content">
                                    <div class="file-manager clearfix">
                                        <a class="btn btn-primary d-block" href="{{route('create_support', auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id : '')}}">Create New Support Message</a>
                                        <!-- Title -->

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email View Header -->
                            <div class="mail-body--area">
                                <div class="mail-windoe-body-area">
                                    <div class="mail-window-header pb-0">
                                        <div class="row justify-content-between">
                                            <div class="col-xs-6">
                                                <div class="mail-window-header-text mb-20">
                                                    <a href="#" class="btn"><i class='bx bx-trash'></i></a>
                                                    <a href="#" class="btn"><i class='bx bx-printer'></i></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mail-window-text-content">
                                        <h6 class="mb-0 font-18">{{$single_support->title_}}</h6>
                                        <p>{{$single_support->created_at->diffForHumans()}}</p>
                                        <div class="mail-avatra d-flex align-items-center mb-30">
                                            <div class="mail-avatar-thumb">
                                                <img src="img/member-img/2.png" alt="">
                                            </div>
                                            <div class="mail-avatra-text">
                                                <h6 class="mb-0 font-15">{{$single_support->SenderDetails->name}}</h6>
                                                <p class="mb-0 font-12">{{$single_support->SenderDetails->email}}</p>
                                            </div>
                                        </div>
                                        <hr>

                                        <div style="padding-left: 10px; padding-top: 2px;">
                                            <p>@php echo $single_support->message @endphp</p>
                                            <div>
                                                <small class="text-dark" style="color:white !important; display: block; width: 50%; ">{{$single_support->SenderDetails->name}}</small>
                                                <small class="text-dark" style="color:white !important; display: block; width: 50%; ">{{$single_support->created_at->diffForHumans()}}</small>
                                            </div>
                                            @php $images = $single_support->Media @endphp
                                            @if(count($images) > 0)
                                                @foreach($images as $k => $eachImage)
                                                    @php $link = auth()->user()->returnLink(); @endphp
                                                    @php $image = asset($link.'support_file/'.$eachImage->file_name); @endphp
                                                    <div style="color:black !important; display: block; width: 20%; ">
                                                        <img src="{{$image}}" class="img-responsive" />
                                                    </div>
                                                @endforeach
                                            @endif
                                            <hr style="margin-bottom: 0px !important;">
                                        </div>


                                        @php $replies = $single_support->SupportReply @endphp

                                        @if(count($replies) > 0)
                                            @foreach($replies as $k => $eachReply)
                                                <div style="padding-left: 10px; padding-top: 2px;">
                                                    <p>@php echo $eachReply->message; @endphp </p>
                                                    <div>
                                                        <small class="text-dark" style="color:black !important; display: block; width: 50%;">{{$eachReply->SenderDetails->name}}</small>
                                                        <small class="text-dark" style="color:black !important; width: 50%; display: block;">{{$eachReply->created_at->diffForHumans()}}</small>
                                                    </div>
                                                    @php $images = $eachReply->Media @endphp
                                                    @if(count($images) > 0)
                                                        <div style="color:black !important; display: block; width: 100%; ">
                                                            <div class="row">
                                                        @foreach($images as $k => $eachImage)
                                                                    @php $link = auth()->user()->returnLink(); @endphp
                                                                    @php $image = asset($link.'support_file/'.$eachImage->file_name); @endphp
                                                                    <div class="col-sm-2">
                                                                        <img src="{{$image}}" class="img-responsive" />
                                                                    </div>
                                                        @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <hr style="margin-bottom: 0px !important;">
                                                </div>
                                            @endforeach
                                        @endif


                                        <div class="mail-body--area" style="margin-top: 20px;">
                                            <div class="box box-primary">
                                                <form method="post" enctype="multipart/form-data" action="{{route('store_support', request()->segment(2))}}">
                                                    @csrf
                                                    <div class="box-header with-border compose">
                                                        @php $AppsSettings = new \App\Models\AppSettings() @endphp
                                                        @php $Settings = $AppsSettings->getSingleModel() @endphp
                                                        <h5 class="mb-30">Send a Reply</h5>
                                                    </div>
                                                    <!-- Box-header -->
                                                    <div class="box-body">

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

                                                            <div class="form-group mb-30" hidden>
                                                                <input name="title_" value="hello" type="text" class="form-control" placeholder="Subject:">
                                                                @error('title_')
                                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                                @enderror
                                                            </div>

                                                        <div class="form-group">
                                                            <textarea name="message"  id="" class="form-control" placeholder="Your Message Here ...">{{old('message')}}</textarea>
                                                            @error('message')
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                            @enderror
                                                        </div>
                                                        <input type="hidden" value="{{auth()->user()->unique_id}}" name="sender_id">
                                                        <input type="hidden" value="{{auth()->user()->type_of_user === 'admin' ? $single_support->SenderDetails->unique_id : auth()->user()->unique_id}}" name="receiver_id" />
                                                        <style>
                                                            .note-editor{
                                                                border-color: black !important;
                                                            }
                                                        </style>
                                                        <div class="form-group">
                                                            <label style="color:#333">Upload an Image File (Optional)</label><br>
                                                            <div class="btn btn-orange btn-file compo-email" style="border-color:black;">
                                                                <i class="fa fa-paperclip font-16 mb-"></i>
                                                                <input multiple type="file" name="file_name[]">
                                                            </div>
                                                            <p class="text-dark" style="color:black;">Max. 40MB</p>
                                                            @error('file_name.0')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                            @error('file_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>
                                                    <!-- Box-body -->
                                                    <div class="box-footer">
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-envelope-o"></i> Reply</button>
                                                            {{--<button type="button" class="btn btn-primary mb-2"><i class="fa fa-pencil"></i> Draft</button>
                                                            <button type="reset" class="btn btn-primary mb-2"><i class="fa fa-times"></i> Discard</button>--}}
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
                </div>
            </div>
        </div>
    </div>


@endsection


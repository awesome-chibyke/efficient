@php $pageTitle = 'View Investment Settings' @endphp

@extends('layouts.design')

@section('content')

<!-- Basic Form area Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-18">ALL Plans</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">ALL Plans</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Form row -->
    <div class="row">


        <div class="col-12 box-margin">
            <div class="card" style="background: #080E32;">
                <div class="card-body">
                    <h4 class="text-danger"><b>All Plans</b> @if(auth()->user()->type_of_user === 'admin')<div class="pull-right"><a title="Please select transaction to be confirmed and then click this button to confirm" href="javascript:;" onclick="deletePlans(this)" class="btn btn-info guoBtn">Delete Plan(s)</a> </div> @endif</h4>

                    @include('dashboard.plans')


                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

    </div>
</div>

@endsection

@php $pageTitle = 'Game History' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Game History</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Game History</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form row -->
        <div class="row">
            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                    <th class="text-center">S / N</th>
                                    <th class="text-center">Game Name</th>
                                    <th class="text-center">Stake Amount</th>
                                    <th class="text-center">Draw Date</th>
                                    <th class="text-center">Draw Time</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Played Number</th>
                                    <th class="text-center">Wining Number</th>
                                </tr>
                                </thead>

                                <tbody class="usersHolds">
                                     <tr role="row" class="odd">
                                        <td class="text-center sorting_1">1</td>
                                        <td class="text-center">Lucky Lotto (5/90) Direct 1</td>
                                        <td class="text-center">106.00 (NGN)</td>
                                         <td class="text-center">Sat, 19th Sep 2020</td>
                                        <td class="text-center">12:45 (pm)</td>
                                        <td class="text-center">
                                            <span class="label label-info p-2">Confirmed</span>
                                        </td>
                                        <td class="text-center">6</td>
                                        <td class="text-center">7,3,0,6,2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

        </div>
    </div>

@endsection

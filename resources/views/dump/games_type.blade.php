@php $pageTitle = 'Games Type' @endphp

@extends('layouts.design')

@section('content')

    <!-- Basic Form area Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-18">Games Type</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Games Type</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Single Ticket pricing Table -->
            <div class="col-12 col-md-6 col-xl-6">
                <div class="single-ticket-pricing-table text-center">
                    <h6 class="ticket-plan">Game Type:</h6>
                    <!-- Ticket Pricing Table Details -->
                    <div class="ticket-pricing-table-details">
                        <table id="scroll-vertical-datatable" class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Title Of Game</th>
                                <th class="text-center">Draw Time</th>
                                <th class="text-center">Type Of Lottery</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">Quick Lotto (5/11) Direct 2</td>
                                    <td class="text-center">2020-09-03</td>
                                    <td class="text-center">Direct</td>
                                    <td class="text-center">
                                        <a href="{{route('play_game')}}" class="btn btn-fill-info">Play</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-30 row setTimeCountDown">

                    </div>
                </div>
            </div>
            <!-- Single Ticket pricing Table -->
            <div class="col-12 col-md-6 col-xl-6">
                <div class="single-ticket-pricing-table text-center">
                    <h6 class="ticket-plan">Game Type:</h6>
                    <!-- Ticket Pricing Table Details -->
                    <div class="ticket-pricing-table-details">
                        <table id="scroll-vertical-datatable" class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Title Of Game</th>
                                <th class="text-center">Draw Time</th>
                                <th class="text-center">Type Of Lottery</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">Quick Lotto (5/11) Direct 2</td>
                                <td class="text-center">2020-09-03</td>
                                <td class="text-center">Direct</td>
                                <td class="text-center">
                                    <a href="{{route('play_game')}}" class="btn btn-fill-info">Play</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-30 row setTimeCountDown">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



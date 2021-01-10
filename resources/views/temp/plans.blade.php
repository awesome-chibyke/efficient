
<div class="row">
    @if(count($investments) > 0)
        @foreach($investments as $k => $eachInvestment)
            <!-- Single Ticket pricing Table -->
                <div class="col-12 col-md-6 col-xl-4" style="position:relative;">
                    <div style="position: absolute; left: 30px; top: 30px;">
                        @if(auth()->user()->type_of_user === 'admin')<input type="checkbox" class="smallCheckBox" value="{{$eachInvestment->unique_id}}"  /> @endif
                    </div>
                    <div class="single-ticket-pricing-table text-center">
                        {{--min_investment_amount,max_investment_amount_switch,max_investment_amount,duration_in_days,deleted_at,created_at,updated_at--}}
                        <h6 class="ticket-plan">{{$eachInvestment->investment_title}}</h6>
                        <!-- Ticket Icon -->
                        <div class="ticket-icon">
                            <i class="icon_pencil-edit_alt"></i>
                        </div>
                        @php $minAmountDetails = auth()->user()->getAmountForView($eachInvestment->min_investment_amount) @endphp
                        @php $maxAmountDetails = $eachInvestment->max_investment_amount_switch === 'on' ? auth()->user()->getAmountForView($eachInvestment->max_investment_amount) : 0 ; @endphp
                        <h2 class="ticket-price" style="color:white !important;"><strong>{{$minAmountDetails['data']['currency']}} {{number_format(round($minAmountDetails['data']['amount']), 2)}} {{$eachInvestment->max_investment_amount_switch === 'on' ? ' - '.number_format(round($maxAmountDetails['data']['amount']), 2) : '' }}</strong></h2>

                        <h5 class="ticket-price" style="color:white;"><strong>Duration: {{round($eachInvestment->duration_in_days)}} days</strong> </h5>
                        @php $rewardsDetails = $eachInvestment->rewardsDetails @endphp
                        {{--reward,amount,reward_type--}}
                    <!-- Ticket Pricing Table Details -->

                        @if(count($rewardsDetails) > 0)
                            @foreach($rewardsDetails as $l => $eachRewardDetails)
                                <div class="ticket-pricing-table-details">
                                    @php
                                        if($eachRewardDetails->reward_type === 'cash'){
                                            $rewardAmountDetails = auth()->user()->getAmountForView($eachRewardDetails->amount);
                                            $reward = 'Earn ('.$rewardAmountDetails['data']['currency'].') '.number_format($rewardAmountDetails['data']['amount'], 2).' in '.round($eachInvestment->duration_in_days).' Days';
                                        }else{
                                            $reward = $eachRewardDetails->reward;
                                        }
                                    @endphp
                                    <p><i class="zmdi zmdi-check"></i>{{$reward}}</p>
                                    {{--<p><i class="zmdi zmdi-check"></i> Social media audit</p>
                                    <p><i class="zmdi zmdi-check"></i> Monthly management</p>
                                    <p><i class="zmdi zmdi-check"></i> Keynote talk</p>
                                    <p><i class="zmdi zmdi-check"></i> Talk to the Editors Session</p>--}}
                                </div>
                            @endforeach
                        @endif

                        <div class="ticket-pricing-table-details">
                            <p><i class="zmdi zmdi-check"></i>Number of Days Deduction for Each Successful Referral: {{$eachInvestment->no_of_days_for_ref}} Days </p>
                        </div>

                        <a target="_blank" href="{{route('view_investments', [$eachInvestment->unique_id, auth()->user()->type_of_user !== 'admin'? auth()->user()->unique_id : ''])}}" class="btn btn-primary w-100 mt-30">{{auth()->user()->type_of_user !== 'admin'? 'View My Investments' : 'View Investments'}} <i class="fa fa-eye"></i> <span class="badge badge-danger">{{$eachInvestment->getAtivePlans($eachInvestment->unique_id)->count()}}</span></a>

                        <a target="_blank" href="{{route('view_due_investments', [$eachInvestment->unique_id, auth()->user()->type_of_user !== 'admin'? auth()->user()->unique_id : ''])}}" class="btn btn-primary w-100 mt-30">{{auth()->user()->type_of_user !== 'admin'? 'View My Due Investments' : 'View Due Investments'}} <i class="fa fa-eye"></i> <span class="badge badge-danger">{{$eachInvestment->getDuePlans($eachInvestment->unique_id)->count()}}</span></a>

                        <a target="_blank" href="{{route('view_investment_history', [$eachInvestment->unique_id, auth()->user()->type_of_user !== 'admin'? auth()->user()->unique_id : ''])}}" class="btn btn-primary w-100 mt-30">{{auth()->user()->type_of_user !== 'admin'? 'History' : 'History'}} <i class="fa fa-eye"></i> <span class="badge badge-danger">{{$eachInvestment->getInactivePlans($eachInvestment->unique_id)->count()}}</span></a>

                        @if(auth()->user()->type_of_user === 'admin' && auth()->user()->admin_level === 'main')
                        {{--<a href="{{route('view_investments', [$eachInvestment->unique_id, auth()->user()->type_of_user !== 'admin'? auth()->user()->unique_id : ''])}}" class="btn btn-primary w-100 mt-30">View Investments <i class="zmdi zmdi-long-arrow-right"></i></a>--}}
                        <a target="_blank" href="{{route('edit_investment_settings_page', [$eachInvestment->unique_id])}}" class="btn btn-primary w-100 mt-30">Edit Investments Package<i class="fa fa-edit"></i></a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 col-md-6 col-xl-4">
                <h1 class="text-center alert alert-warning">No Data Available</h1>
            </div>
        @endif


    </div>
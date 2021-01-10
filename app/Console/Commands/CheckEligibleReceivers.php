<?php

namespace App\Console\Commands;

use App\Models\InvestmentRewardCheck;
use App\Models\InvestmentStore;
use App\Models\TransactionModel;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckEligibleReceivers extends Command
{
    use Generics;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:eligible';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for user that are eligible to receive their result';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvestmentStore $investmentStore, InvestmentRewardCheck $investmentRewardCheck, TransactionModel $transactionModel)
    {
        parent::__construct();
        $this->investmentStore = $investmentStore;
        $this->investmentRewardCheck = $investmentRewardCheck;
        $this->transactionModel = $transactionModel;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->rewardDayChecker();
        echo 'done';
    }

    //create
    function rewardDayChecker(){

        //select all the active investment
        $allInvestments = $this->investmentStore->getRowsWhere([
            ['status', '=', 'active']
        ]);
        $dateNow = Carbon::now()->toDateTimeString();
        if(count($allInvestments) > 0){
            //echo response()->json($allInvestments); return;
            foreach($allInvestments as $k => $eachInvestment){

                $expirationDate = Carbon::parse($eachInvestment->created_at)->addDays($eachInvestment->time_remaining_in_days)->toDateTimeString();
                
                if($expirationDate <= $dateNow && $eachInvestment->time_remaining_in_days == 0){

                    $allReferrals = $eachInvestment->getAllReferralForAnInvestment($eachInvestment->referral_id);//get the investment settings

                    //check and know if the user has upto two referrals
                    $cashReward =  count($allReferrals) >= 2 ? $eachInvestment->InvestmentPlan->amount_for_referral : $eachInvestment->InvestmentPlan->amount_for_no_referral;

                    //create the reward check for amount
                    $rewardObject = $this->investmentRewardCheck->createRewardsForInvestment($eachInvestment, null, 'cash','done', $cashReward);
                    /*echo  json_encode($rewardObject); return;*/
                    $this->investmentRewardCheck->createNewInvestmentRewardCheck($rewardObject);

                    //add the said amount to user wallet
                    $UserDetails = $eachInvestment->UserDetails;
                    $UserDetails->balance = $UserDetails->balance + $cashReward;
                    $UserDetails->save();

                    $this->createNewTransaction($eachInvestment, $cashReward);//create new transaction

                    //check to  the reward check table to make sure no incentive disbursement is pending
                    $rewardCheckStatus = $this->investmentRewardCheck->getRowsWhere([
                        ['status', '=', 'pending'],
                        ['investment_unique_id', '=', $eachInvestment->unique_id]
                    ]);

                    //assign value for the status of the investment
                    $eachInvestment->status = count($rewardCheckStatus) == 0 ? 'done' : 'processing_rewards';
                    //$this->investmentStore->updateInvestment($eachInvestment);
                    $eachInvestment->save();

                }


            }

        }


    }

    function createNewTransaction($eachInvestment, $amount){

        $unique_id = $this->createUniqueId('transaction_models', 'unique_id');
        $request = [];
        $request['unique_id'] = $unique_id;
        $request['user_unique_id'] = $eachInvestment->user_unique_id;
        $request['amount'] = $amount;
        $request['description'] = 'Reward for Investment';
        $request['action_type'] = 'top_up';
        $request['top_up_option'] = '';
        $request['status'] = 'confirmed';
        $object = json_decode(json_encode($request), FALSE);
        return $this->transactionModel->insertIntoTransactionModel($object);

    }


}

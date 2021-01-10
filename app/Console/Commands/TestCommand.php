<?php

namespace App\Console\Commands;

use App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Update of Remaining days on Investment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvestmentStore $investmentStore, InvestmentSettings $investmentSettings, User $user)
    {
        parent::__construct();
        $this->investmentStore = $investmentStore;
        $this->investmentSettings = $investmentSettings;
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //return 0;
        $this->updateInvestments();
    }

    function updateInvestments(){

        $investments = $this->investmentStore->getRowsWhere([
            ['status', '=', 'active']
        ]);

        $dateNow = Carbon::now()->toDateTimeString();
        if(count($investments) > 0){

            foreach($investments as $k => $eachInvestment){

                $NextUpdateTime = Carbon::parse($eachInvestment->time_regulator)->addHours(24)->toDateTimeString();
                if($NextUpdateTime <= $dateNow && $eachInvestment->time_remaining_in_days != 0){
                    $eachInvestment->time_remaining_in_days = $eachInvestment->time_remaining_in_days - 1;
                    $eachInvestment->time_regulator = Carbon::now()->toDateTimeString();
                    $eachInvestment->save();
                }//update the investment time to new value

            }

        }

    }

}

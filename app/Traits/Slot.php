<?php

namespace App\Traits;

use \App\Models\AppSettings;
use \App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\TransactionModel;

trait Slot{

    //check if new slot can be actually added
    function checkSlotValidity($currentAmountBeingAdded){

        $appSettings = new AppSettings();
        $InvestmentSettings = new InvestmentSettings();
        $Settings = $appSettings->getSingleModel();

        //array of available slots
        $availableSlots = [];

        $investmentSettingsArrays = $InvestmentSettings->getAllRows();//get all the investment setups
        if(count($investmentSettingsArrays) > 0){
            foreach($investmentSettingsArrays as $eachLeastAmountForSlot){//loop through the setup and make an array of the amount
                $availableSlots[] = $eachLeastAmountForSlot->min_investment_amount;
            }

            if(count($availableSlots) > 0){
                sort($availableSlots);//sort amount in acsending order
            }

            $slot = $Settings->slot_setup;//extract the slot settings

            $leastAmountForSlot = $availableSlots[0];

            $maxPossibleSlot = $leastAmountForSlot * $slot; //maximi=um possible slot
            if($maxPossibleSlot < $currentAmountBeingAdded){
                return [
                    'status'=>false,
                    'error'=>$currentAmountBeingAdded.' cannot be greater than current maximum possible slot ('.$maxPossibleSlot.') for this system, please adjust settings from the Website`s main settings area.'
                ];
            }
            //get modulus of the least amount and
            $modulus = $currentAmountBeingAdded % $leastAmountForSlot;
            if($modulus != 0){
                return [
                        'status'=>false,
                        'error'=>$currentAmountBeingAdded.' is greater than current maximum possible slot ('.$maxPossibleSlot.') for the system, please adjust settings from the Website`s main settings area.'
                    ];
            }
            return [
                'status'=>true,
            ];;
        }

    }


    function validateInvestmentAmount($amountBeingInvested, $userUniqueId){//validate the investment amount to make sure user is still within the investment limit

        $appSettings = new AppSettings();
        $InvestmentSettings = new InvestmentSettings();
        $transactionModel = new TransactionModel();
        $Settings = $appSettings->getSingleModel();

        //array of available slots
        $availableSlots = [];

        $investmentSettingsArrays = $InvestmentSettings->getAllRows();//get all the investment setups
        if(count($investmentSettingsArrays) > 0) {
            foreach ($investmentSettingsArrays as $eachLeastAmountForSlot) {//loop through the setup and make an array of the amount
                $availableSlots[] = $eachLeastAmountForSlot->amount;
            }

            if (count($availableSlots) > 0) {

                sort($availableSlots);//sort amount in acsending order

                //select all the investment in the system and get the total for the individaul so far
                $allUserInvestment = InvestmentStore::where('user_unique_id', $userUniqueId)->get();

                $sumOfAllInvestment = $allUserInvestment->sum('main_amount');//summ of all investment made by user so far

                $amountForLastSlot = $availableSlots[count($availableSlots)-1];//last amount in the slot amount array after sorting

                if(round($sumOfAllInvestment) == round($amountForLastSlot)){
                    $amountForLastSlotDetails = $transactionModel->getAmountForView($amountForLastSlot);
                    return [
                        'status'=>false,
                        'error'=>'you can not create a new investment as your slot is now complete ('.$amountForLastSlotDetails['data']['currency'].') '.number_format(round($amountForLastSlotDetails['data']['amount']))
                    ];
                }

                $TotalAmountRemainingForUserToInvest = $amountForLastSlot - $sumOfAllInvestment;//total amount user can still invest

                if(round($amountBeingInvested) > round($TotalAmountRemainingForUserToInvest)){//heck if the amount user wants to invest is greater

                    //$key = array_search($TotalAmountRemainingForUserToInvest, $availableSlots);
                    $key = $this->returnArrayKey($TotalAmountRemainingForUserToInvest, $availableSlots);
                    if($key == -1){
                        return [
                            'status'=>false,
                            'error'=>'Amount entered is invalid!'
                        ];
                    }

                    array_splice($availableSlots, $key+1);

                    return [
                        'status'=>false,
                        'error'=>'you can only create investment for the following slot(s) at this time '.implode(', ', $this->generateAmountList($availableSlots, $transactionModel))
                    ];

                }

                return [
                    'status'=>true
                ];

            }

        }

    }


    function generateAmountList($arrayOfAmount, $transactionModel){
        $amountArray = [];
        foreach($arrayOfAmount as $k => $eachAmount){

            $amountDetails = $transactionModel->getAmountForView($eachAmount);
            $amountArray[] = '('.$amountDetails['data']['currency'].') '.number_format(round($amountDetails['data']['amount']));

        }
        return $amountArray;

    }

    function returnArrayKey($valueToCheck, $array){

        foreach($array as $k => $eachArray){
            if(round($eachArray) == round($valueToCheck)){
                return $k;
            }
        }
        return -1;

    }

}

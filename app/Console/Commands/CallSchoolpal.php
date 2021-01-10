<?php

namespace App\Console\Commands;

use App\Models\CurrencyRatesModel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CallSchoolpal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:schoolpal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->callSchoolPal();
    }

    function callSchoolPal(){

        //

        // Initialize CURL:
        $ch = curl_init('https://schools.lightgates.app/automation');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        //$exchangeRates = json_decode($json);
        echo $json;

    }
}

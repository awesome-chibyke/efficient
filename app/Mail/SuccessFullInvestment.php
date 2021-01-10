<?php

namespace App\Mail;

use App\Models\InvestmentStore;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessFullInvestment extends Mailable
{
    use Queueable, SerializesModels;

    protected $values;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InvestmentStore $investmentStore)
    {
        $this->investmentStore = $investmentStore;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.successfull_investment')
            ->with([
                'siteDetails' => $this->investmentStore->siteDetails,
                'investmentDetails' => $this->investmentStore,
                'investmentPlan' => $this->investmentStore->investmentPlan,
                'userDetails' => $this->investmentStore->userDetails,
            ]);
    }
}

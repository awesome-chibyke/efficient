<?php

namespace App\Mail;

use App\Models\InvestmentStore;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RewardDispensationNotifier extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->view('emails.reward_dispensation')
                ->with([
                    'siteDetails' => $this->investmentStore->siteDetails,
                    'investmentDetails' => $this->investmentStore,
                    'investmentPlan' => $this->investmentStore->investmentPlan,
                    'userDetails' => $this->investmentStore->userDetails,
                ]);
    }
}

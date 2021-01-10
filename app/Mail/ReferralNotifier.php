<?php

namespace App\Mail;

use App\Models\InvestmentStore;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralNotifier extends Mailable
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
        return $this->view('emails.successful_referral')
            ->with([
                'siteDetails' => $this->investmentStore->siteDetails,
                'referrerInvestmentDetails' => $this->investmentStore,
                'referredInvestmentDetails' => $this->investmentStore->referredInvestmentDetails,
                'ReferrerUserDetails' => $this->investmentStore->ReferrerUserDetails
            ]);
    }
}

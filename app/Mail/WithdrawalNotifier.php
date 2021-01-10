<?php

namespace App\Mail;

use App\Models\TransactionModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalNotifier extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TransactionModel $transactionModel)
    {
        $this->transactionModel = $transactionModel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin_withdrawal')
            ->with([
                'siteDetails' => $this->transactionModel->siteDetails,
                'transactionDetails' => $this->transactionModel,
                'userDetails' => $this->transactionModel->userDetails,
            ]);
    }
}

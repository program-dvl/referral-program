<?php

namespace App\Listeners;

use App\Events\SentReferralEmail;
use App\Models\User;
use Mail;

class SendReferralEmailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SentReferralEmail  $event
     * @return void
     */
    public function handle(SentReferralEmail $event)
    {
        foreach ($event->referralEmails as $key => $email) {
            $data['name'] = $event->referredUserName;
            $data['referral_link'] = $event->referralLink;
            Mail::send('emails.ReferralEmailEvent', $data, function ($message) use ($data, $email) {
                $message->to($email);
                $message->subject($data['name'].' recommends ContactOut');
            });
        }
    }
}

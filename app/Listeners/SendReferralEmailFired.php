<?php

namespace App\Listeners;

use App\Events\SentReferralEmail;
use App\Models\User;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            $user = User::find($event->referredBy);
            $data['name'] = $user->name;
            $data['referral_link'] = $user->referral_link;
            Mail::send('emails.ReferralEmailEvent', $data, function($message) use ($data, $email) {
                $message->to($email);
                $message->subject($data['name'].' recommends ContactOut');
            });
        }
    }
}

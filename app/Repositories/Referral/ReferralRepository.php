<?php
namespace App\Repositories\Referral;

use App\Events\SentReferralEmail;
use App\Models\ReferralUser;
use App\Models\User;
use Carbon\Carbon;
use Event;
use Illuminate\Support\Arr;

class ReferralRepository
{
    /**
     * @var App\Models\ReferralUser
     */
    private $referralUser;
    
    /**
     * @var App\Models\User
     */
    private $user;

    /**
     * Create a new repository instance.
     *
     */
    public function __construct(
        ReferralUser $referralUser,
        User $user
    ) {
        $this->referralUser = $referralUser;
        $this->user = $user;
    }
    
    /**
     * Send Referral Emails
     *
     * @param array $referralUsers
     * @param User $refferedBy
     * @param string $referral_link
     * @return null
     */
    public function send(array $referralUsers, User $refferedBy)
    {
        $referralData = [];
        foreach ($referralUsers as $key => $user) {
            $referralData[] = [
               'referral_email' => $user,
               'referred_by' => $refferedBy->id,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
            ];
        }
        $this->referralUser->insert($referralData);
        $referralEmails = Arr::pluck($referralData, 'referral_email');

        // Send Email to referrals
        Event::dispatch(new SentReferralEmail(
            $referralEmails, 
            $refferedBy->referral_link, 
            $refferedBy->name
        ));
    }

    /**
     * Update user's referral points
     *
     * @param array $email
     * @param int $referralCode
     * @return null
     */
    public function updateReferralPoint(string $email, string $referralCode)
    {
        $user = $this->user->where('referral_token', $referralCode)->first();

        $referralUser = $this->referralUser->where(
            [
                'referred_by' => $user->id,
                'referral_email' => $email
            ]
        )->first();

        if (!empty($referralUser)) {

            // Increment user's referral point
            $user->update(
                [
                   'points' => $user->points + 1
               ]
            );

            // Update user's referral status
            $referralUser->update(
                [
                    'status' => config('constants.referral_status.INVITATION_ACCEPTED')
                ]
            );
        }
    }

    /**
     * Get Referrals list
     *
     * @return array
     */
    public function referralsList(): array
    {
        $referrals = $this->referralUser->with(['user'])->get();
        return (count($referrals)) ? $referrals->toArray() : [];
    }
}

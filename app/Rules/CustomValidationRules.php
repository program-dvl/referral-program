<?php
namespace App\Rules;

use App\Models\ReferralUser;
use Illuminate\Support\Facades\Validator;

class CustomValidationRules
{
    public static function validate()
    {
        Validator::extend('check_max_referral', function ($attribute, $field, $value) {
            $count = ReferralUser::where(
                [
                    'referred_by' => $value,
                    'status' => config('constants.referral_status.INVITATION_ACCEPTED')
                ]
            )->count();

            return ($count >= config('constants.maximum_referral_limit')) ? false : true;
        });
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendReferralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Auth::user();
        return [
            "emails" => 'array|min:1',
            "emails.*" => 'email|not_in:'.$user->email.'|unique:users,email|unique:referral_users,referral_email|check_max_referral:'.$user->id,
        ];
    }

    public function messages()
    {
        return [
            'emails.array' => 'Emails field must by type of array!',
            'emails.min' => 'Atleast 1 email is required',
            'emails.*.email' => 'Please use valid email address.',
            'emails.*.not_in' => 'You can not use your email',
            'emails.*.unique' => 'Email already signed up into the system or it has been already referred by someone else'
        ];
    }
}

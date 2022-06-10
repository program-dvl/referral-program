<?php

namespace App\Http\Controllers\Referral;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendReferralRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Referral\ReferralRepository;
use Throwable;

//!  Referral controller
/*!
This controller is responsible for handling referral feature realated operations.
 */
class ReferralController extends Controller
{
    /**
     * @var App\Repositories\Referral\ReferralRepository
     */
    private $referralRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReferralRepository $referralRepository)
    {
        $this->middleware('auth');
        $this->referralRepository = $referralRepository;
    }

    /**
    * Send Referral code to users
    *
    * @param App\Http\Requests\SendReferralRequest
    */
    public function index(SendReferralRequest $sendReferralRequest)
    {
        $validated = $sendReferralRequest->validated();
        $referredBy = Auth::user();
        $referralUsers = $validated['emails'];
        
        try {
            $this->referralRepository->send($referralUsers, $referredBy);
        } catch (Throwable $e) {
            $data = [
                'message' => trans('message.custom_error_message.REFERRAL_SENT_FAILED'),
                'code' => Response::HTTP_FORBIDDEN
            ];
            return response()->json($data, Response::HTTP_FORBIDDEN, [], JSON_NUMERIC_CHECK);
        }
        $data = [
            'message' => trans('message.success.REFFERAL_SENT_SUCCESS'),
            'code' => Response::HTTP_OK
        ];
        return response()->json($data, Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }
}

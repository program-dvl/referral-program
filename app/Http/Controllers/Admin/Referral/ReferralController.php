<?php

namespace App\Http\Controllers\Admin\Referral;

use App\Http\Controllers\Controller;
use App\Repositories\Referral\ReferralRepository;
use Illuminate\Http\Response;
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
        $this->referralRepository = $referralRepository;
    }

    /**
    * Get all the referrals details
    *
    */
    public function index()
    {
        try {
            $list = $this->referralRepository->referralsList();
        } catch (Throwable $e) {
            $data = [
                'message' => trans('message.custom_error_message.REFERRAL_LIST_FAILED'),
                'code' => Response::HTTP_FORBIDDEN
            ];
            return response()->json($data, Response::HTTP_FORBIDDEN, [], JSON_NUMERIC_CHECK);
        }
        $data = [
            'data' => $list,
            'message' => trans('message.success.REFFERAL_LIST_SUCCESS'),
            'code' => Response::HTTP_OK
        ];
        return response()->json($data, Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }
}

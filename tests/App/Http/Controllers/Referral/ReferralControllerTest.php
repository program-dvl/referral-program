<?php

namespace Tests\Unit\Http\Controllers\Referral;

use App\Http\Controllers\Referral\ReferralController;
use App\Http\Requests\SendReferralRequest;
use App\Models\User;
use App\Repositories\Referral\ReferralRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;
use Throwable;

class ReferralControllerTest extends TestCase
{
    /**
     * @var App\Repositories\Referral\ReferralRepository
     */
    private $referralRepository;

    /**
     * @var App\Http\Controllers\Referral\ReferralController
     */
    private $referralController;

    /**
     * @var App\Http\Requests\SendReferralRequest;
     */
    private $sendReferralRequest;

    /**
     * @var App\Models\User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->referralRepository = $this->mock(ReferralRepository::class);
        $this->sendReferralRequest = $this->mock(SendReferralRequest::class);
        $this->user = $this->mock(User::class);

        $this->referralController = new ReferralController($this->referralRepository);
    }

    /**
     * Test index method on ReferralController class on the success exit
     * @testdox void
     */
    public function testIndexSuccess()
    {
        $testRequest = [
            'emails' => [
                'test@gmail.com'
            ]
        ];

        Auth::shouldReceive('user')->once()->andreturn($this->user);

        $this->sendReferralRequest
            ->shouldReceive('validated')
            ->once()
            ->andReturn($testRequest);

        $this->referralRepository
            ->shouldReceive('send')
            ->with($testRequest['emails'], $this->user)
            ->once()
            ->andReturn(null);

        $response = $this->referralController->index($this->sendReferralRequest);
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
    * Mock an object
    *
    * @param string name
    *
    * @return Mockery
    */
    public function mock($class)
    {
        return Mockery::mock($class);
    }
}

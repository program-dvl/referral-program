<?php

namespace Tests\Unit\Http\Controllers\Admin\Referral;

use App\Http\Controllers\Admin\Referral\ReferralController;
use App\Models\User;
use App\Repositories\Referral\ReferralRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class ReferralControllerTest extends TestCase
{
    /**
     * @var App\Repositories\Referral\ReferralRepository
     */
    private $referralRepository;

    /**
     * @var App\Http\Controllers\Admin\Referral\ReferralController
     */
    private $referralController;

    public function setUp(): void
    {
        parent::setUp();
        $this->referralRepository = $this->mockClass(ReferralRepository::class);
        $this->user = $this->mockClass(User::class);

        $this->referralController = new ReferralController($this->referralRepository);
    }

    /**
     * Test index method on ReferralController class on the success exit
     * @testdox void
     */
    public function testIndexSuccess()
    {

        $this->referralRepository
            ->shouldReceive('referralsList')
            ->once()
            ->andReturn([]);

        $response = $this->referralController->index();
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
    * Mock an object
    *
    * @param string name
    *
    * @return Mockery
    */
    public function mockClass($class)
    {
        return Mockery::mock($class);
    }
}

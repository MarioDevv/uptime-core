<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\Logout;

use MarioDevv\Uptime\Monitoring\Application\Logout\Logout;
use MarioDevv\Uptime\Monitoring\Application\Logout\LogoutRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\LogoutFailedException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserNotFoundException;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\AuthUnitTestHelper;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\UserDataMother;

class LogoutTest extends AuthUnitTestHelper
{

    private Logout $logout;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logout = new Logout($this->repository());
    }

    /** @test */
    public function it_should_logout_a_user()
    {

        $request = new LogoutRequest(rand(1, 10));

        $this->byId(
            $request->id(),
            UserDataMother::random(id: $request->id())
        );

        $this->logout($request->id(), true);

        ($this->logout)($request);
    }


    /** @test */
    public function it_should_throw_an_error_when_user_not_found()
    {

        $this->expectException(UserNotFoundException::class);

        $request = new LogoutRequest(rand(1, 10));

        $this->byId(
            $request->id(),
            null
        );

        ($this->logout)($request);
    }

    /** @test */
    public function it_should_throw_an_error_when_login_fails()
    {

        $this->expectException(LogoutFailedException::class);

        $request = new LogoutRequest(rand(1, 10));

        $this->byId(
            $request->id(),
            UserDataMother::random(id: $request->id())
        );

        $this->logout($request->id(), false);

        ($this->logout)($request);
    }

}
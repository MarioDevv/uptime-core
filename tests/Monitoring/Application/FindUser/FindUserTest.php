<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\FindUser;

use MarioDevv\Uptime\Monitoring\Application\FindUser\FindUser;
use MarioDevv\Uptime\Monitoring\Application\FindUser\FindUserRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserNotFoundException;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\AuthUnitTestHelper;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\UserDataMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\UserEmailMother;

class FindUserTest extends AuthUnitTestHelper
{

    private FindUser $findUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->findUser = new FindUser($this->repository());
    }


    /** @test */
    public function it_should_find_a_user()
    {
        $request = new FindUserRequest(rand(1, 10));

        $userData = UserDataMother::random();

        $this->byId($request->id(), $userData);

        $response = ($this->findUser)($request);

        $this->assertEquals($response->id(), $userData->id());
        $this->assertEquals($response->email(), $userData->email());
        $this->assertEquals($response->name(), $userData->name());
    }

    /** @test */
    public function it_should_throw_an_error_when_user_not_found()
    {

        $this->expectException(UserNotFoundException::class);

        $request = new FindUserRequest(rand(1, 10));

        $this->byId($request->id(), null);

        ($this->findUser)($request);

    }
}
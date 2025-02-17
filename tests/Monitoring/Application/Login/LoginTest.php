<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\Login;

use MarioDevv\Uptime\Monitoring\Application\Login\Login;
use MarioDevv\Uptime\Monitoring\Application\Login\LoginRequest;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\LoginFailedException;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\AuthUnitTestHelper;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\UserEmailMother;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth\UserPasswordMother;

class LoginTest extends AuthUnitTestHelper
{

    private Login $login;

    protected function setUp(): void
    {
        parent::setUp();

        $this->login = new Login($this->repository());
    }


    /** @test */
    public function it_should_login_a_user()
    {

        $email    = UserEmailMother::random();
        $password = UserPasswordMother::random();

        $request = new LoginRequest(
            $email->value(),
            $password->value()
        );

        $this->login($email, $password, true);

        ($this->login)($request);

    }


    /** @test */
    public function it_should_throw_an_error_when_login_fails()
    {

        $this->expectException(LoginFailedException::class);

        $email    = UserEmailMother::random();
        $password = UserPasswordMother::random();

        $request = new LoginRequest(
            $email->value(),
            $password->value()
        );

        $this->login($email, $password, false);

        ($this->login)($request);

    }

}
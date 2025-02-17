<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Auth;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\AuthRepository;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserData;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserEmail;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserPassword;
use MarioDevv\Uptime\Tests\Utils\Infrastructure\UnitTestCase;
use Mockery\MockInterface;

abstract class AuthUnitTestHelper extends UnitTestCase
{

    private ?AuthRepository $repository = null;

    protected function byId(int $id, ?UserData $userData): void
    {
        $this->repository()
            ->shouldReceive('byId')
            ->with($this->equalTo($id))
            ->andReturn($userData);
    }

    protected function login(UserEmail $email, UserPassword $password, bool $success): void
    {
        $this->repository()
            ->shouldReceive('login')
            ->with($this->equalTo($email), $this->equalTo($password))
            ->andReturn($success);
    }

    protected function logout(int $id, bool $success): void
    {
        $this->repository()
            ->shouldReceive('logout')
            ->with($this->equalTo($id))
            ->andReturn($success);
    }


    protected function repository(): MockInterface
    {
        return $this->repository ??= $this->mock(AuthRepository::class);
    }

}
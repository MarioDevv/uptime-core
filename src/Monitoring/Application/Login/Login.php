<?php

namespace MarioDevv\Uptime\Monitoring\Application\Login;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\AuthRepository;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\InvalidUserEmailException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\InvalidUserPasswordException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\LoginFailedException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserEmail;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserPassword;

class Login
{

    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws InvalidUserEmailException
     * @throws InvalidUserPasswordException
     * @throws LoginFailedException
     */
    public function __invoke(LoginRequest $request): void
    {

        $email    = new UserEmail($request->email());
        $password = new UserPassword($request->password());

        $success = $this->repository->login($email, $password);

        if (!$success) {
            throw new LoginFailedException();
        }

    }

}
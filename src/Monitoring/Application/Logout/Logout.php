<?php

namespace MarioDevv\Uptime\Monitoring\Application\Logout;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\AuthRepository;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\LogoutFailedException;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserNotFoundException;

class Logout
{

    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserNotFoundException
     * @throws LogoutFailedException
     */
    public function __invoke(LogoutRequest $request): void
    {

        $userData = $this->repository->byId($request->id());

        if (null === $userData) {
            throw new UserNotFoundException();
        }

        $success = $this->repository->logout($userData->id());

        if (!$success) {
            throw new LogoutFailedException();
        }
    }

}
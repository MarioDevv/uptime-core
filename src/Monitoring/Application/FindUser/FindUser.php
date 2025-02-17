<?php

namespace MarioDevv\Uptime\Monitoring\Application\FindUser;

use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\AuthRepository;
use MarioDevv\Uptime\Monitoring\Domain\Model\Auth\UserNotFoundException;

class FindUser
{

    private AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(FindUserRequest $request): FindUserResponse
    {

        $userData = $this->repository->byId($request->id());

        if (null === $userData) {
            throw new UserNotFoundException();
        }

        return new FindUserResponse(
            $userData->id(),
            $userData->email(),
            $userData->name()
        );

    }

}
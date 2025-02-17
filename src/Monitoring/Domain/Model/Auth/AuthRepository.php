<?php

namespace MarioDevv\Uptime\Monitoring\Domain\Model\Auth;

interface AuthRepository
{

    public function byId(int $id): ?UserData;

    public function login(UserEmail $email, UserPassword $password): bool;

    public function logout(int $id): bool;

}
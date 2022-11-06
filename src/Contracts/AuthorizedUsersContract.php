<?php

namespace Dainsys\HumanResource\Contracts;

interface AuthorizedUsersContract
{
    public function has(string $email): bool;
}

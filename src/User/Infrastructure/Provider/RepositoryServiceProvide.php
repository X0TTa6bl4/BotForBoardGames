<?php

namespace src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use src\User\Domain\Repository\UserRepositoryContract;
use src\User\Infrastructure\Repository\UserRepository;

class RepositoryServiceProvide extends ServiceProvider
{
    public array $bindings = [
        UserRepositoryContract::class => UserRepository::class,
    ];
}

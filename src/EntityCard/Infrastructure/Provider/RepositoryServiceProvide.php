<?php

namespace src\EntityCard\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;
use src\EntityCard\Domain\Repository\GroupBattleRepositoryContract;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;
use src\EntityCard\Domain\Repository\UserRepositoryContract;
use src\EntityCard\Infrastructure\Repository\EntityCardRepository;
use src\EntityCard\Infrastructure\Repository\GroupBattleRepository;
use src\EntityCard\Infrastructure\Repository\GroupRepository;
use src\EntityCard\Infrastructure\Repository\UserRepository;

class RepositoryServiceProvide extends ServiceProvider
{
    public array $bindings = [
        EntityCardRepositoryContract::class => EntityCardRepository::class,
        GroupRepositoryContract::class => GroupRepository::class,
        UserRepositoryContract::class => UserRepository::class,
        GroupBattleRepositoryContract::class => GroupBattleRepository::class,
    ];
}

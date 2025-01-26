<?php

namespace src\Battle\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use src\Battle\Domain\Repository\BattleRepositoryContract;
use src\Battle\Infrastructure\Repository\BattleRepository;

class RepositoryServiceProvide extends ServiceProvider
{
    public array $bindings = [
        BattleRepositoryContract::class => BattleRepository::class
    ];
}

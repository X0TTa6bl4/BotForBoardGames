<?php

namespace src\Battle\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;

class BattleServiceProvide extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvide::class);
        $this->app->register(ActionServiceProvide::class);
    }
}

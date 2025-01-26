<?php

namespace src\EntityCard\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;

class EntityCardServiceProvide extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionServiceProvide::class
        );

        $this->app->register(
            RuleServiceProvide::class
        );

        $this->app->register(
            RepositoryServiceProvide::class
        );
    }
}

<?php

namespace src\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;

class UserServiceProvide extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvide::class);
    }
}

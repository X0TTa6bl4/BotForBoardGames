<?php

namespace src\EntityCard\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use src\EntityCard\Application\Action\IsThereAGroupOwnedByTheUserContract;
use src\EntityCard\Infrastructure\Action\IsThereAGroupOwnedByTheUserAction;

class ActionServiceProvide extends ServiceProvider
{
    public array $bindings = [
        IsThereAGroupOwnedByTheUserContract::class => IsThereAGroupOwnedByTheUserAction::class,
    ];
}

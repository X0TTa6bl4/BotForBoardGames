<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Action;

use src\EntityCard\Application\Action\SetEntityIdInteractionContract;

class SetEntityIdInteractionAction implements SetEntityIdInteractionContract
{
    public function __construct()
    {
    }

    public function __invoke(int $userId, int $entityId): void
    {

    }
}

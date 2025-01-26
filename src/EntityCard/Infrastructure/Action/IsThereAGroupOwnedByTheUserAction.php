<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Action;

use src\EntityCard\Application\Action\IsThereAGroupOwnedByTheUserContract;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;

class IsThereAGroupOwnedByTheUserAction implements IsThereAGroupOwnedByTheUserContract
{
    public function __construct(
        private readonly GetGroupByOwnerIdUseCase $getGroupByOwnerIdUseCase
    )
    {
    }

    public function __invoke(int $userId): bool
    {
        return ($this->getGroupByOwnerIdUseCase)($userId) !== null;
    }
}

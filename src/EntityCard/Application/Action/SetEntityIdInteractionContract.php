<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Action;

interface SetEntityIdInteractionContract
{
    public function __invoke(int $userId, int $entityId): void;
}

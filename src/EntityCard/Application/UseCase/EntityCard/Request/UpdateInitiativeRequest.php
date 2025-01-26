<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard\Request;

class UpdateInitiativeRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly int $initiative,
    )
    {
    }
}

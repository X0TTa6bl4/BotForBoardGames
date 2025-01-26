<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard\Request;

class RestoreHealthRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly int $entityIdThatDealsHealth,
        public readonly int $entityIdThatTakesHealth
    )
    {
    }
}

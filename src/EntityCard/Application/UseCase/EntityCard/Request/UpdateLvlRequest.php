<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard\Request;

class UpdateLvlRequest
{
    public function __construct(
        public readonly int $userId,
        public readonly int $lvl,
    )
    {
    }
}

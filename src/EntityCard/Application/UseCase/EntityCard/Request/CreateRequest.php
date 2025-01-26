<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard\Request;

class CreateRequest
{
    public function __construct(
        public readonly int    $userId,
        public readonly string $name,
        public readonly int    $healthPoints,
        public readonly int    $power,
        public readonly int    $initiative,
        public readonly int    $intelligence,
        public readonly int    $lvl,
        public readonly int    $protection,
    )
    {
    }
}

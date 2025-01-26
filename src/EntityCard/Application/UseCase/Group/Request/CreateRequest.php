<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group\Request;

class CreateRequest
{
    public function __construct(
        public readonly string $name,
        public readonly int    $ownerId
    )
    {
    }
}

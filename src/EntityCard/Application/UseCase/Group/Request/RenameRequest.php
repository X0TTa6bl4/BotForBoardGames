<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group\Request;

class RenameRequest
{
    public function __construct(
        public readonly int    $ownerId,
        public readonly string $newName
    )
    {
    }
}

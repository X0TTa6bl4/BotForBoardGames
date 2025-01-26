<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase\Request;

class CreateRequest
{
    public function __construct(
        public readonly int   $groupId,
        public readonly array $entitiesInCombat
    )
    {
    }
}

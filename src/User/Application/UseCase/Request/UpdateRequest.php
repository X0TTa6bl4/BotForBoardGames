<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Request;

class UpdateRequest
{
    public function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly string $state,
        public readonly ?int   $entityIdInteraction = null
    )
    {
    }
}

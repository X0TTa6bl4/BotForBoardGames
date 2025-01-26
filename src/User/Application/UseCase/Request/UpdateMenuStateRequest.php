<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Request;

class UpdateMenuStateRequest
{
    public function __construct(
        public readonly int    $id,
        public readonly string $state
    )
    {
    }
}

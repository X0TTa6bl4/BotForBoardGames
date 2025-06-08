<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Request;

readonly class UpdateRequest
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $state,
        public ?int   $entityIdInteraction = null,
        public ?int   $messageId = null
    )
    {
    }
}

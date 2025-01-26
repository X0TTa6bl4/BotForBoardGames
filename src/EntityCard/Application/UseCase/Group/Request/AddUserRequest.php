<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group\Request;

class AddUserRequest
{
    public function __construct(
        public readonly string $publicGroupId,
        public readonly int $chatId,
    )
    {
    }
}

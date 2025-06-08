<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Response;

readonly class UserResponse
{
    public function __construct(
        public int $id,
        public string $name,
        public int $chatId,
        public string $menuState,
        public int $messageId,
    ) {
    }
}

<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Request;

readonly class UpdateLastMessageIdRequest
{
    public function __construct(
        public int $id,
        public int $lastMessageId,
    ) {
    }
}

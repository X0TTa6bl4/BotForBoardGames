<?php

declare(strict_types=1);

namespace src\User\Application\UseCase\Request;

readonly class CreateRequest
{
    public function __construct(
        public string $name,
        public int    $chatId
    )
    {
    }
}

<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure;

class Menu
{
    private string $type;
    private string $message;
    private string $handler;

    public function __construct(string $type, string $message, string $handler)
    {
        $this->type = $type;
        $this->message = $message;
        $this->handler = $handler;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }
}

<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class NameValueObject
{
    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) < 3) {
            throw new \InvalidArgumentException('Name must be at least 3 characters long');
        }
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }
}

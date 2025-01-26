<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class IdValueObject
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}

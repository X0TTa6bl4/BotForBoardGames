<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class InitiativeValueObject
{
    private readonly int $initiative;

    public function __construct(int $initiative)
    {
        if ($initiative < 0) {
            throw new \InvalidArgumentException('Initiative must be greater than 0');
        }
        $this->initiative = $initiative;
    }

    public function getValue(): int
    {
        return $this->initiative;
    }
}

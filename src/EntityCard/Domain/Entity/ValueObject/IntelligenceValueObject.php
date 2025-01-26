<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class IntelligenceValueObject
{
    private int $speed;

    public function __construct(int $speed)
    {
        if ($speed < 0) {
            throw new \InvalidArgumentException('Speed must be greater than 1');
        }
        $this->speed = $speed;
    }

    public function getValue(): int
    {
        return $this->speed;
    }
}

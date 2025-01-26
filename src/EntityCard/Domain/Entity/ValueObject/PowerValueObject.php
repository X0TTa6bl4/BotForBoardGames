<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class PowerValueObject
{
    private int $power;

    public function __construct(int $power)
    {
        if ($power < 0) {
            throw new \InvalidArgumentException('Power must be greater than 1');
        }
        $this->power = $power;
    }

    public function getValue(): int
    {
        return $this->power;
    }
}

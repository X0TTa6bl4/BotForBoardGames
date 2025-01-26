<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class LvlValueObject
{
    private readonly int $lvl;

    public function __construct(int $lvl)
    {
        if ($lvl < 1) {
            throw new \InvalidArgumentException('Lvl must be greater than 1');
        }
        $this->lvl = $lvl;
    }

    public function getValue(): int
    {
        return $this->lvl;
    }
}

<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class DamageValueObject
{
    private int $damage;

    public function __construct(int $damage)
    {
        if ($damage < 0) {
            throw new \InvalidArgumentException('Damage must be greater than 0');
        }
        $this->damage = $damage;
    }

    public function getValue(): int
    {
        return $this->damage;
    }
}

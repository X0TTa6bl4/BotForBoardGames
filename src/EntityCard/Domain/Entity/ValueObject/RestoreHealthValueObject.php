<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class RestoreHealthValueObject
{
    private int $restoreHealth;

    public function __construct(int $restoreHealth)
    {
        if ($restoreHealth < 0) {
            throw new \InvalidArgumentException('Restore health must be greater than 0');
        }
        $this->restoreHealth = $restoreHealth;
    }

    public function getValue(): int
    {
        return $this->restoreHealth;
    }
}

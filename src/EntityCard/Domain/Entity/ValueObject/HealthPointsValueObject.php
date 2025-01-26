<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class HealthPointsValueObject
{
    private int $healthPoints;
    private int $maxHealthPoints;

    public function __construct(int $healthPoints, int $maxHealthPoints)
    {
        if ($healthPoints < 0) {
            throw new \InvalidArgumentException('Health points must be greater than 0');
        }
        if ($maxHealthPoints < 1) {
            throw new \InvalidArgumentException('Max health points must be greater than 1');
        }
        $this->healthPoints = $healthPoints;
        $this->maxHealthPoints = $maxHealthPoints;
    }

    public function getValue(): int
    {
        return $this->healthPoints;
    }

    public function getMaxHealthPoints(): int
    {
        return $this->maxHealthPoints;
    }
}

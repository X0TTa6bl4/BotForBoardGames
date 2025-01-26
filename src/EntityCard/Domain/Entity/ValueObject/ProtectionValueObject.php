<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity\ValueObject;

class ProtectionValueObject
{
    private int $protection;

    public function __construct(int $protection)
    {
        if ($protection < 0) {
            throw new \InvalidArgumentException('Protection must be greater than 0');
        }
        $this->protection = $protection;
    }

    public function getValue(): int
    {
        return $this->protection;
    }
}

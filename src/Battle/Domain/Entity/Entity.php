<?php

declare(strict_types=1);

namespace src\Battle\Domain\Entity;

class Entity
{
    private int $id;
    private int $initiative;
    private int $healthPoints;

    public function __construct(int $id, int $initiative, int $healthPoints)
    {
        $this->id = $id;
        $this->initiative = $initiative;
        $this->healthPoints = $healthPoints;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInitiative(): int
    {
        return $this->initiative;
    }

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }
}

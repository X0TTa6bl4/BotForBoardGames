<?php

declare(strict_types=1);

namespace src\Battle\Domain\Entity;

use Illuminate\Support\Collection;

class Battle
{
    private ?int $id;
    private int $groupId;
    private ?int $entityIdMakeAMove;
    private Collection $entitiesInCombat;

    public function __construct(?int $id, int $groupId, array $entitiesInCombat, int $entityIdMakeAMove = null)
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->entitiesInCombat = collect($entitiesInCombat)
            ->sortByDesc(fn(Entity $entity) => $entity->getInitiative())
            ->filter(fn(Entity $entity) => $entity->getHealthPoints() > 0)
            ->values();

        $this->entityIdMakeAMove = $entityIdMakeAMove ?? $this->entitiesInCombat->first()->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getEntityIdMakeAMove(): ?int
    {
        return $this->entityIdMakeAMove;
    }

    public function getEntitiesInCombat(): Collection
    {
        return $this->entitiesInCombat;
    }

    public function getEntityById(int $id): ?Entity
    {
        return $this->entitiesInCombat->first(fn(Entity $entity) => $entity->getId() === $id);
    }

    public function completeAMove(): void
    {
        $this->entityIdMakeAMove = $this->getNextEntityIdToMakeAMove();
    }

    private function getNextEntityIdToMakeAMove(): int
    {
        $entityIds = $this->entitiesInCombat->map(fn(Entity $entity) => $entity->getId());
        $entityIdMakeAMoveIndex = $entityIds->search($this->entityIdMakeAMove);
        $nextEntityIdMakeAMoveIndex = $entityIdMakeAMoveIndex + 1;
        if ($nextEntityIdMakeAMoveIndex === $entityIds->count()) {
            $nextEntityIdMakeAMoveIndex = 0;
        }
        return $entityIds->get($nextEntityIdMakeAMoveIndex);
    }

    public function getEntitiesIdInCombat(): array
    {
        return $this->entitiesInCombat->map(fn(Entity $entity) => $entity->getId())->toArray();
    }
}

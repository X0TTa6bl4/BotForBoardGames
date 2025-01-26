<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Repository;

use src\EntityCard\Domain\Entity\EntityCard;

interface EntityCardRepositoryContract
{
    public function create(EntityCard $player): EntityCard;

    public function update(EntityCard $entity): bool;

    public function upsert(array $entities): int;

    public function getById(int $id): EntityCard;

    public function getByUserId(int $userId): array;

    public function delete($id): void;
}

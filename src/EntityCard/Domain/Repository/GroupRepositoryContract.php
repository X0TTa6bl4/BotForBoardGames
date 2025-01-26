<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Repository;

use src\EntityCard\Domain\Entity\Group;

interface GroupRepositoryContract
{
    public function create(Group $group): Group;

    public function update(Group $group): bool;

    public function getById(int $id): Group;

    public function getByOwnerId(int $ownerId): ?Group;

    public function getByPublicId(string $publicId): ?Group;

    public function getByUserId(int $userId): ?Group;

    public function delete(int $id): void;
}

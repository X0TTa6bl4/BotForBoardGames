<?php

declare(strict_types=1);

namespace src\Battle\Domain\Repository;

use src\Battle\Domain\Entity\Battle;

interface BattleRepositoryContract
{
    public function getById(int $id): Battle;

    public function create(Battle $battle): Battle;

    public function update(Battle $battle): bool;

    public function delete(int $id): void;

    public function getByGroupId(int $groupId): Battle;

    public function deleteByGroupId(int $groupId): void;
}

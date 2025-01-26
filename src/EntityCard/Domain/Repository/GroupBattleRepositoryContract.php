<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Repository;

interface GroupBattleRepositoryContract
{
    public function isHasBattle(int $groupId): bool;
}

<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Repository;

use App\Models\Group;
use src\EntityCard\Domain\Repository\GroupBattleRepositoryContract;

class GroupBattleRepository implements GroupBattleRepositoryContract
{

    public function isHasBattle(int $groupId): bool
    {
        return Group::query()->has('battle')->where('id', $groupId)->exists();
    }
}

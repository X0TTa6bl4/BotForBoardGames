<?php

declare(strict_types=1);

namespace src\Battle\Infrastructure\Action;

use src\Battle\Application\Action\IsHasBattleContract;
use src\EntityCard\Domain\Repository\GroupBattleRepositoryContract;

class IsHasBattleAction implements IsHasBattleContract
{
    public function __construct(
        private readonly GroupBattleRepositoryContract $groupBattleRepository
    )
    {
    }

    public function __invoke(int $groupId): bool
    {
        return $this->groupBattleRepository->isHasBattle($groupId);
    }
}

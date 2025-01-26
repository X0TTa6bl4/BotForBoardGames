<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase;

use src\Battle\Domain\Entity\Battle;
use src\Battle\Domain\Repository\BattleRepositoryContract;

class CompleteAMoveUseCase
{
    public function __construct(
        private readonly BattleRepositoryContract $battleRepository
    )
    {
    }

    public function __invoke(int $battleId): Battle
    {
        $battle = $this->battleRepository->getById($battleId);
        $battle->completeAMove();
        $this->battleRepository->update($battle);
        return $battle;
    }
}

<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase;

use src\Battle\Domain\Entity\Battle;
use src\Battle\Domain\Repository\BattleRepositoryContract;

class GetByIdUseCase
{
    public function __construct(
        private readonly BattleRepositoryContract $battleRepository
    )
    {
    }

    public function __invoke(int $id): Battle
    {
        return $this->battleRepository->getById($id);
    }
}

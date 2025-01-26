<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase;

use src\Battle\Domain\Repository\BattleRepositoryContract;

class DeletedBattleByGroupIdUseCase
{
    public function __construct(
        private readonly BattleRepositoryContract $battleRepository
    )
    {
    }

    public function __invoke(int $id): void
    {
        $this->battleRepository->deleteByGroupId($id);
    }
}

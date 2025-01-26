<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase;

use src\Battle\Domain\Repository\BattleRepositoryContract;

class DeletedBattleUseCase
{
    public function __construct(
        private readonly BattleRepositoryContract $battleRepository
    )
    {
    }

    public function __invoke(int $id): void
    {
        $this->battleRepository->delete($id);
    }
}

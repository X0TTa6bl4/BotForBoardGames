<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group;

use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class GetGroupByMemberIdUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository
    )
    {
    }

    public function __invoke(int $userId): ?Group
    {
        return $this->groupRepository->getByUserId($userId);
    }
}

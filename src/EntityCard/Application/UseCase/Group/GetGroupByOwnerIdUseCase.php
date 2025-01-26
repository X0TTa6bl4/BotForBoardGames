<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group;

use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class GetGroupByOwnerIdUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository
    )
    {
    }

    public function __invoke(int $ownerId): ?Group
    {
        return $this->groupRepository->getByOwnerId($ownerId);
    }
}

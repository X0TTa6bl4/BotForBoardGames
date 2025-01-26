<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\RestoreHealthRequest;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class RestoreHealthUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository,
    )
    {
    }

    public function __invoke(RestoreHealthRequest $request): int
    {
        $group = $this->groupRepository->getByUserId($request->userId);
        if ($group === null) {
            $group = $this->groupRepository->getByOwnerId($request->userId);
        }

        $restoreHealth = $group->restoreHealth($request->entityIdThatDealsHealth, $request->entityIdThatTakesHealth);

        $this->groupRepository->update($group);
        return $restoreHealth;
    }
}

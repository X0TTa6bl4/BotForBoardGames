<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group;

use src\EntityCard\Application\Builder\GroupBuilder;
use src\EntityCard\Application\UseCase\Group\Request\CreateRequest;
use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class CreateUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository,
        private readonly GroupBuilder            $groupBuilder
    )
    {
    }

    public function __invoke(CreateRequest $request): Group
    {
        $group = $this->groupRepository->getByOwnerId($request->ownerId);
        if ($group !== null) {
            return $group;
        }
        return $this->groupRepository->create(
            $this->groupBuilder->fromCreate($request)
        );
    }
}

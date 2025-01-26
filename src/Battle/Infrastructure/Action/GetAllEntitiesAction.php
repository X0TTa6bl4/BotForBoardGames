<?php

declare(strict_types=1);

namespace src\Battle\Infrastructure\Action;

use src\Battle\Application\Action\GetAllEntitiesContract;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class GetAllEntitiesAction implements GetAllEntitiesContract
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository
    )
    {
    }

    public function __invoke(int $groupId): array
    {
        return array_map(
            fn($entity) => [
                'id' => $entity->getId(),
                'initiative' => $entity->getInitiative(),
                'healthPoints' => $entity->getHealthPoints(),
            ],
            $this->groupRepository->getById($groupId)->getAllEntities()
        );
    }
}

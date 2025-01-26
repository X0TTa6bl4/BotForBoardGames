<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\Builder\EntityCardBuilder;
use src\EntityCard\Application\UseCase\EntityCard\Request\CreateRequest;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class CreateAnEntityToUpdateTheFieldsUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository,
        private readonly EntityCardBuilder            $entityCardBuilder
    )
    {
    }

    public function __invoke(int $userId): int
    {
        $entity = $this
            ->entityCardBuilder
            ->fromCreate(
                new CreateRequest(
                    userId: $userId,
                    name: 'default',
                    healthPoints: 1,
                    power: 1,
                    initiative: 1,
                    intelligence: 1,
                    lvl: 1,
                    protection: 1
                )
            );

        $entity = $this->entityCardRepository->create($entity);

        return $entity->getId();
    }
}

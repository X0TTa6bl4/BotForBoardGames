<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class GetUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(int $id): EntityCard
    {
        return $this->entityCardRepository->getById($id);
    }
}

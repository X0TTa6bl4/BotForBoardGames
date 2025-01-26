<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\SetHealthPointsRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\HealthPointsValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class SetHealthPointsUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(SetHealthPointsRequest $request): EntityCard
    {
        $entityCard = $this->entityCardRepository->getById($request->userId);
        $entityCard->setHealthPoints(new HealthPointsValueObject($request->healthPoints, $request->healthPoints));
        $this->entityCardRepository->update($entityCard);

        return $entityCard;
    }
}

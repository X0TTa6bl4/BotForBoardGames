<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateIntelligenceRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\IntelligenceValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class UpdateIntelligenceUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(UpdateIntelligenceRequest $request): EntityCard
    {
        $entityCard = $this->entityCardRepository->getById($request->userId);
        $entityCard->updateSpeed(new IntelligenceValueObject($request->intelligence));
        $this->entityCardRepository->update($entityCard);

        return $entityCard;
    }
}

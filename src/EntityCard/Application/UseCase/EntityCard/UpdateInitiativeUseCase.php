<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateInitiativeRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\InitiativeValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class UpdateInitiativeUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(UpdateInitiativeRequest $request): EntityCard
    {
        $entityCard = $this->entityCardRepository->getById($request->userId);
        $entityCard->updateInitiative(new InitiativeValueObject($request->initiative));
        $this->entityCardRepository->update($entityCard);

        return $entityCard;
    }
}

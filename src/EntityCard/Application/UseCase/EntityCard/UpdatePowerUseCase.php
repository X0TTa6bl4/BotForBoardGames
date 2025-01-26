<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\UpdatePowerRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\PowerValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class UpdatePowerUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(UpdatePowerRequest $request): EntityCard
    {
        $entityCard = $this->entityCardRepository->getById($request->userId);
        $entityCard->updatePower(new PowerValueObject($request->power));
        $this->entityCardRepository->update($entityCard);

        return $entityCard;
    }
}

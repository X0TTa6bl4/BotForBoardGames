<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateLvlRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\LvlValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class UpdateLvlUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(UpdateLvlRequest $request): EntityCard
    {
        $entityCard = $this->entityCardRepository->getById($request->userId);
        $entityCard->updateLvl(new LvlValueObject($request->lvl));
        $this->entityCardRepository->update($entityCard);

        return $entityCard;
    }
}

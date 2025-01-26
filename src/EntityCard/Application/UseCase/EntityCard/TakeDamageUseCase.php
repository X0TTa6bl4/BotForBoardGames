<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\TakeDamageRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\DamageValueObject;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class TakeDamageUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function __invoke(TakeDamageRequest $request): EntityCard
    {
        $player = $this->entityCardRepository->getById($request->userId);
        $player->takeDamage(new DamageValueObject($request->damage));
        $this->entityCardRepository->update($player);

        return $player;
    }
}

<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\UseCase\EntityCard\Request\MakeDamageRequest;
use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class MakeDamageUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(MakeDamageRequest $request): int
    {
        $group = $this->groupRepository->getByUserId($request->userId);
        if ($group === null) {
            $group = $this->groupRepository->getByOwnerId($request->userId);
        }

        $damage = $group->damage($request->entityIdThatDealsDamage, $request->entityIdThatTakesDamage);

        $this->groupRepository->update($group);
        return $damage;
    }
}

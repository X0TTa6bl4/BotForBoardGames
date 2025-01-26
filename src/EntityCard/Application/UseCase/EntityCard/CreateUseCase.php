<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\EntityCard;

use src\EntityCard\Application\Builder\EntityCardBuilder;
use src\EntityCard\Application\UseCase\EntityCard\Request\CreateRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;
use src\EntityCard\Domain\Rule\IsItPossibleToCreateAnEntityRuleContract;

class CreateUseCase
{
    public function __construct(
        private readonly EntityCardRepositoryContract             $entityCardRepository,
        private readonly GroupRepositoryContract                  $groupRepository,
        private readonly EntityCardBuilder                        $entityBuilder,
        private readonly IsItPossibleToCreateAnEntityRuleContract $itPossibleToCreateAnEntityRule
    )
    {
    }

    public function __invoke(CreateRequest $request): ?EntityCard
    {
        $group = $this->groupRepository->getByUserId($request->userId);

        if (!($this->itPossibleToCreateAnEntityRule)($group, $request->userId)) {
            return null;
        }

        return $this->entityCardRepository->create(
            $this->entityBuilder->fromCreate($request)
        );
    }
}

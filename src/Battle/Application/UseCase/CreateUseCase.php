<?php

declare(strict_types=1);

namespace src\Battle\Application\UseCase;

use src\Battle\Application\Action\GetAllEntitiesContract;
use src\Battle\Application\Action\IsHasBattleContract;
use src\Battle\Application\Builder\BattleBuilder;
use src\Battle\Domain\Entity\Battle;
use src\Battle\Domain\Repository\BattleRepositoryContract;

class CreateUseCase
{
    public function __construct(
        private readonly BattleRepositoryContract $battleRepository,
        private readonly BattleBuilder            $battleBuilder,
        private readonly IsHasBattleContract      $isHasBattle,
        private readonly GetAllEntitiesContract   $getAllEntities
    )
    {
    }

    public function __invoke(int $groupId): Battle
    {
        if (($this->isHasBattle)($groupId)) {
            throw new \Exception('Group has a battle');
        }
        $entities = ($this->getAllEntities)($groupId);
        $battle = $this->battleBuilder->fromCreate($groupId, $entities);
        return $this->battleRepository->create($battle);
    }
}

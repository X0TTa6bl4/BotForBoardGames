<?php

declare(strict_types=1);

namespace src\Battle\Application\Builder;

use App\Models\Battle as BattleEloquentModel;
use src\Battle\Domain\Entity\Battle;

class BattleBuilder
{
    public function __construct(
        private readonly EntityBuilder $entityBuilder
    )
    {
    }

    public function fromEloquentModel(?BattleEloquentModel $battle): Battle
    {
        if ($battle === null) {
            throw new \Exception('Battle not found');
        }
        return new Battle(
            id: $battle->id,
            groupId: $battle->group_id,
            entitiesInCombat: $battle->entities->map(fn($entity) => $this->entityBuilder->fromEloquentModel($entity)
            )->toArray(),
            entityIdMakeAMove: $battle->entity_id_make_a_move
        );
    }

    public function fromCreate(int $groupId, array $entity): Battle
    {
        return new Battle(
            id: null,
            groupId: $groupId,
            entitiesInCombat: array_map(fn($entity) => $this->entityBuilder->fromCreate($entity),
                $entity)
        );
    }
}

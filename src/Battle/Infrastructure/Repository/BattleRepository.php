<?php

declare(strict_types=1);

namespace src\Battle\Infrastructure\Repository;

use App\Models\Battle as BattleEloquentModel;
use src\Battle\Application\Builder\BattleBuilder;
use src\Battle\Domain\Entity\Battle;
use src\Battle\Domain\Entity\Entity;
use src\Battle\Domain\Repository\BattleRepositoryContract;

class BattleRepository implements BattleRepositoryContract
{

    public function __construct(
        private readonly BattleBuilder $battleBuilder
    )
    {
    }

    public function getById(int $id): Battle
    {
        /** @var BattleEloquentModel $battleEloquentModel */
        $battleEloquentModel = BattleEloquentModel::query()->find($id)?->entities();

        return $this->battleBuilder->fromEloquentModel($battleEloquentModel);
    }

    public function create(Battle $battle): Battle
    {
        /** @var BattleEloquentModel $battleEloquentModel */
        $battleEloquentModel = BattleEloquentModel::query()->create([
            'entities_in_combat' => json_encode(
                $battle->getEntitiesInCombat()
                    ->map(fn(Entity $entity) => $entity->getId())
            ),
            'entity_id_make_a_move' => $battle->getEntityIdMakeAMove(),
            'group_id' => $battle->getGroupId(),
        ])->entities();

        return $this->battleBuilder->fromEloquentModel($battleEloquentModel);
    }

    public function update(Battle $battle): bool
    {
        return BattleEloquentModel::query()->find($battle->getId())->update([
            'entity_id_make_a_move' => $battle->getEntityIdMakeAMove(),
            'entities_in_combat' => $battle->getEntitiesIdInCombat(),
        ]);
    }

    public function delete(int $id): void
    {
        BattleEloquentModel::query()->find($id)->delete();
    }

    public function getByGroupId(int $groupId): Battle
    {
        /** @var BattleEloquentModel $battleEloquentModel */
        $battleEloquentModel = BattleEloquentModel::query()->where('group_id', $groupId)->first()?->entities();

        return $this->battleBuilder->fromEloquentModel($battleEloquentModel);
    }
    public function deleteByGroupId(int $groupId): void
    {
        BattleEloquentModel::query()->where('group_id', $groupId)->delete();
    }
}

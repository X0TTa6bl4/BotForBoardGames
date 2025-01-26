<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Repository;

use App\Models\Entity as EntityEloquentModel;
use src\EntityCard\Application\Builder\EntityCardBuilder;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;

class EntityCardRepository implements EntityCardRepositoryContract
{
    public function __construct(
        private readonly EntityCardBuilder $entityBuilder
    )
    {
    }

    public function create(EntityCard $player): EntityCard
    {
        /** @var EntityEloquentModel $EntitiesEloquentModel */
        $EntitiesEloquentModel = EntityEloquentModel::query()->create([
            'user_id' => $player->getUserId(),
            'name' => $player->getName(),
            'health_points' => $player->getHealthPoints(),
            'health_points_max' => $player->getHealthPoints(),
            'power' => $player->getPower(),
            'initiative' => $player->getInitiative(),
            'intelligence' => $player->getIntelligence(),
            'lvl' => $player->getLvl(),
            'protection' => $player->getProtection(),
        ]);

        return $this->entityBuilder->fromEloquentModel($EntitiesEloquentModel);
    }

    public function update(EntityCard $entity): bool
    {
        $EntitiesEloquentModel = EntityEloquentModel::query()->find($entity->getId())->update([
            'name' => $entity->getName(),
            'health_points' => $entity->getHealthPoints(),
            'health_points_max' => $entity->getMaxHealthPoints(),
            'power' => $entity->getPower(),
            'initiative' => $entity->getInitiative(),
            'intelligence' => $entity->getIntelligence(),
            'lvl' => $entity->getLvl(),
            'protection' => $entity->getProtection(),
        ]);

        return $EntitiesEloquentModel;
    }

    public function upsert(array $entities): int
    {
        return EntityEloquentModel::query()->upsert(
            array_map(
                function (EntityCard $entity) {
                    return [
                        'id' => $entity->getId(),
                        'user_id' => $entity->getUserId(),
                        'name' => $entity->getName(),
                        'health_points' => $entity->getHealthPoints(),
                        'health_points_max' => $entity->getMaxHealthPoints(),
                        'power' => $entity->getPower(),
                        'initiative' => $entity->getInitiative(),
                        'intelligence' => $entity->getIntelligence(),
                        'lvl' => $entity->getLvl(),
                        'protection' => $entity->getProtection(),
                    ];
                },
                $entities
            ),
            ['id'],
            [
                'name',
                'health_points',
                'health_points_max',
                'power',
                'initiative',
                'intelligence',
                'lvl',
                'protection',
            ]
        );
    }

    public function getById(int $id): EntityCard
    {
        /** @var EntityEloquentModel $EntitiesEloquentModel */
        $EntitiesEloquentModel = EntityEloquentModel::query()->find($id);

        return $this->entityBuilder->fromEloquentModel($EntitiesEloquentModel);
    }

    public function getByUserId(int $userId): array
    {
        /** @var EntityEloquentModel $EntitiesEloquentModel */
        $EntitiesEloquentModel = EntityEloquentModel::query()->where('user_id', $userId)->get();

        $users = [];

        foreach ($EntitiesEloquentModel as $entity) {
            $users[] = $this->entityBuilder->fromEloquentModel($entity);
        }

        return $users;
    }

    public function delete($id): void
    {
        EntityEloquentModel::query()->find($id)->delete();
    }
}

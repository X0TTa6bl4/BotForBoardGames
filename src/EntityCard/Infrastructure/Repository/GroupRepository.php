<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Repository;

use App\Models\Entity;
use App\Models\Group as GroupEloquentModel;
use src\EntityCard\Application\Builder\GroupBuilder;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Repository\EntityCardRepositoryContract;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;

class GroupRepository implements GroupRepositoryContract
{
    public function __construct(
        private GroupBuilder                 $groupBuilder,
        private EntityCardRepositoryContract $entityCardRepository
    )
    {
    }

    public function create(Group $group): Group
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()->create([
            'name' => $group->getName(),
            'public_id' => $group->getPublicId(),
            'owner_id' => $group->getOwnerId()
        ]);

        return $this->groupBuilder->fromEloquentModel($groupEloquentModel);
    }

    public function update(Group $group): bool
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()->find($group->getId());
        GroupEloquentModel::query()->find($group->getId())->update([
            'name' => $group->getName(),
            'owner_id' => $group->getOwnerId()
        ]);

        $entities = [];
        foreach ($group->getAllUsers() as $user) {
            /** @var EntityCard $entity */
            foreach ($user->getEntities() as $entity) {
                if ($entity->getHealthPoints() !== 0) {
                    $entities[] = $entity;
                } else {
                    Entity::query()->find($entity->getId())->delete();
                }
            }
        }

        $groupEloquentModel->players()->sync(array_map(fn($user) => $user->getId(), $group->getUsers()));

        $this->entityCardRepository->upsert($entities);

        return GroupEloquentModel::query()->find($group->getId())->update([
            'name' => $group->getName(),
            'owner_id' => $group->getOwnerId()
        ]);
    }

    public function getById(int $id): Group
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()->with([
            'owner.entities',
            'players.entities'
        ])->find($id);

        return $this->groupBuilder->fromEloquentModel($groupEloquentModel);
    }

    public function getByOwnerId(int $ownerId): ?Group
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()
            ->where('owner_id', $ownerId)
            ->with([
                'owner.entities',
                'players.entities'
            ])->first();

        return $groupEloquentModel ? $this->groupBuilder->fromEloquentModel($groupEloquentModel) : null;
    }

    public function getByPublicId(string $publicId): ?Group
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()
            ->where('public_id', $publicId)
            ->with([
                'owner.entities',
                'players.entities'
            ])->first();

        return $groupEloquentModel ? $this->groupBuilder->fromEloquentModel($groupEloquentModel) : null;
    }

    public function getByUserId(int $userId): ?Group
    {
        /** @var GroupEloquentModel $groupEloquentModel */
        $groupEloquentModel = GroupEloquentModel::query()
            ->whereHas('players', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with([
                'owner.entities',
                'players.entities'
            ])->first();

        return $groupEloquentModel ? $this->groupBuilder->fromEloquentModel($groupEloquentModel) : null;
    }

    public function delete(int $id): void
    {
        GroupEloquentModel::query()->find($id)->delete();
    }
}

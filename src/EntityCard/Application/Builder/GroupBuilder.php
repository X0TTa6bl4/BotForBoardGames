<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Builder;

use App\Models\Group as GroupEloquentModel;
use Illuminate\Support\Str;
use src\EntityCard\Application\UseCase\Group\Request\CreateRequest;
use src\EntityCard\Domain\Entity\Group;

class GroupBuilder
{
    public function __construct(
        private readonly UserBuilder $userBuilder
    )
    {
    }

    public function fromCreate(CreateRequest $request): Group
    {
        return new Group(
            id: null,
            publicId: (string)Str::uuid(),
            name: $request->name,
            ownerId: $request->ownerId,
            owner: null,
            users: [],
        );
    }

    public function fromEloquentModel(GroupEloquentModel $group): Group
    {
        return new Group(
            id: $group->id,
            publicId: $group->public_id,
            name: $group->name,
            ownerId: $group->owner_id,
            owner: $this->userBuilder->fromEloquentModel($group?->owner),
            users: $group->players?->map(fn($user) => $this->userBuilder->fromEloquentModel($user))->toArray() ?? [],
        );
    }
}

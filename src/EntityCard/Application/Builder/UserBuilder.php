<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Builder;

use App\Models\User as UserEloquentModel;
use src\EntityCard\Domain\Entity\User;

class UserBuilder
{
    public function __construct(
        private readonly EntityCardBuilder $entityBuilder
    )
    {
    }

    public function fromEloquentModel(?UserEloquentModel $user): ?User
    {
        if (!$user) {
            return null;
        }
        return new User(
            id: $user->id,
            name: $user->name,
            chatId: $user->chat_id,
            entities: $user
            ->entities
            ?->map(fn($entity) => $this->entityBuilder->fromEloquentModel($entity))
            ->toArray() ?? []
        );
    }
}

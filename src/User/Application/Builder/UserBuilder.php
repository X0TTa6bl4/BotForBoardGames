<?php

declare(strict_types=1);

namespace src\User\Application\Builder;

use App\Models\User as UserEloquentModel;
use src\User\Application\UseCase\Request\CreateRequest;
use src\User\Domain\Entity\User;

class UserBuilder
{
    public function fromCreate(CreateRequest $request): User
    {
        return new User(
            id: null,
            name: $request->name,
            chatId: $request->chatId,
            menuState: 'default',
        );
    }

    public function fromEloquentModel(UserEloquentModel $user): ?User
    {
        return new User(
            id: $user->id,
            name: $user->name,
            chatId: $user->chat_id,
            menuState: $user->menu_state,
            entityIdInteraction: $user->userEntityInteraction?->entity_id,
            messageId: $user->message_id,
        );
    }
}

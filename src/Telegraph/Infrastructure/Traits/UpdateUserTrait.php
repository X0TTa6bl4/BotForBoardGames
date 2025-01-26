<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Traits;

use src\User\Application\UseCase\Request\UpdateRequest;
use src\User\Application\UseCase\UpdateUseCase;
use src\User\Domain\Entity\User;

trait UpdateUserTrait
{
    protected function updateUser(User $user): void
    {
        app(UpdateUseCase::class)(
            new UpdateRequest(
                id: $user->getId(),
                name: $user->getName(),
                state: $user->getMenuState(),
                entityIdInteraction: $user->getEntityIdInteraction()
            )
        );
    }
}

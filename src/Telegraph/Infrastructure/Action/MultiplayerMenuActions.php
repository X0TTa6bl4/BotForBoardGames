<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use src\EntityCard\Application\UseCase\Group\CreateUseCase as EntityCreateUseCase;
use src\EntityCard\Application\UseCase\Group\Request\CreateRequest as EntityCreateRequest;
use src\EntityCard\Domain\Entity\Group;
use src\Telegraph\Infrastructure\Handler;
use src\User\Application\UseCase\GetByChatIdUseCase;
use src\User\Application\UseCase\Request\UpdateMenuStateRequest;
use src\User\Application\UseCase\UpdateMenuStateUseCase;
use src\User\Domain\Entity\User;

/**
 * @mixin Handler
 */
trait MultiplayerMenuActions
{
    public function createWorld(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        /** @var Group $group */
        $group = app(EntityCreateUseCase::class)(
            new EntityCreateRequest(
                name: 'World',
                ownerId: $user->getId()
            )
        );
        $user->setMenuState('mainMenu');
        app(UpdateMenuStateUseCase::class)(
            new UpdateMenuStateRequest(
                id: $user->getId(),
                state: $user->getMenuState()
            )
        );
        $this->chat->message("Мир создан, <code>{$group->getPublicId()}</code>")->send();
        $this->currentMenu();
    }

    public function joinWorld(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());
        $user->setMenuState('connectToWorld');
        $this->updateUser($user);
        $this->chat->message($this->getMenu($user->getMenuState())->getMessage())->send();
    }
}

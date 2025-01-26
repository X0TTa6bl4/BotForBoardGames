<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use App\Models\Entity;
use src\EntityCard\Application\UseCase\EntityCard\CreateAnEntityToUpdateTheFieldsUseCase;
use src\Telegraph\Infrastructure\Handler;
use src\User\Application\UseCase\GetByChatIdUseCase;
use src\User\Domain\Entity\User;

/**
 * @mixin Handler
 */
trait CreateEntityMainActions
{
    public function createRandomEntity(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        $entity = Entity::factory()->create([
            'user_id' => $user->getId(),
        ]);

        $this->chat->message("Существо создано: {$entity->name}")->send();
        $this->setMainMenu($user);
        $this->currentMenu();
    }

    public function createEntityWithParams(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());
        $entityId = app(CreateAnEntityToUpdateTheFieldsUseCase::class)($user->getId());
        $user->setEntityIdInteraction($entityId);
        $user->setMenuState('setName');
        $this->updateUser($user);
        $this->chat->message(
            $this->getMenu(
                $user->getMenuState()
            )->getMessage()
        )->send();
    }

    public function fromCreateEntityGoToMainMenu(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());
        $this->setMainMenu($user);
        $this->currentMenu();
    }
}

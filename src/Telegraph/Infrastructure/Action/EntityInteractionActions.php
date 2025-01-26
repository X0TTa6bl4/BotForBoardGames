<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use DefStudio\Telegraph\Models\TelegraphChat;
use src\Battle\Application\UseCase\CompleteAMoveUseCase;
use src\Battle\Application\UseCase\GetByGroupIdUseCase;
use src\Battle\Domain\Entity\Battle;
use src\EntityCard\Application\Action\IsThereAGroupOwnedByTheUserContract;
use src\EntityCard\Application\UseCase\EntityCard\GetUseCase;
use src\EntityCard\Application\UseCase\EntityCard\MakeDamageUseCase;
use src\EntityCard\Application\UseCase\EntityCard\Request\MakeDamageRequest;
use src\EntityCard\Application\UseCase\EntityCard\Request\RestoreHealthRequest;
use src\EntityCard\Application\UseCase\EntityCard\RestoreHealthUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByMemberIdUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\Group;
use src\Telegraph\Infrastructure\Handler;
use src\User\Application\UseCase\GetByChatIdUseCase;
use src\User\Domain\Entity\User;

/**
 * @mixin Handler
 */
trait EntityInteractionActions
{
    private readonly EntityCard $entityPerformingAnAction;
    private readonly EntityCard $entityOnWhichTheActionIsPerformed;
    private readonly User $user;
    private ?Group $group;

    public function attackEntity(): void
    {
        $this->setModels();

        $damage = app(MakeDamageUseCase::class)(
            new MakeDamageRequest(
                userId: $this->user->getId(),
                entityIdThatDealsDamage: $this->entityPerformingAnAction->getId(),
                entityIdThatTakesDamage: $this->entityOnWhichTheActionIsPerformed->getId()
            )
        );

        $this->sendAMessageToAllGroupMembers(
            $this->group,
            "{$this->entityPerformingAnAction->getName()} наносит {$damage} урона {$this->entityOnWhichTheActionIsPerformed->getName()}"
        );

        $this->setMainMenu($this->user);
        $this->currentMenu();
    }

    public function healEntity(): void
    {
        $this->setModels();

        $restoreHealth = app(RestoreHealthUseCase::class)(
            new RestoreHealthRequest(
                userId: $this->user->getId(),
                entityIdThatDealsHealth: $this->entityPerformingAnAction->getId(),
                entityIdThatTakesHealth: $this->entityOnWhichTheActionIsPerformed->getId()
            )
        );

        $this->sendAMessageToAllGroupMembers(
            $this->group,
            "{$this->entityPerformingAnAction->getName()} восстанавливает {$restoreHealth} очков здоровья {$this->entityOnWhichTheActionIsPerformed->getName()}"
        );

        $this->setMainMenu($this->user);
        $this->currentMenu();
    }

    public function endYourTurn(): void
    {
        $user = $this->getUser();
        /** @var Group $group */
        $group = app(GetGroupByMemberIdUseCase::class)($user->getId());
        if ($group === null) {
            $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());
        }

        $battle = app(GetByGroupIdUseCase::class)($group->getId());

        /** @var EntityCard $entity */
        $entity = app(GetUseCase::class)($battle->getEntityIdMakeAMove());

        if (
            app(IsThereAGroupOwnedByTheUserContract::class)($user->getId())
            || $entity->getUserId() === $user->getId()
        ) {
            $battle = app(CompleteAMoveUseCase::class)($battle->getId());
        }
        /** @var EntityCard $entityMakingNextMove */
        $entityMakingNextMove = app(GetUseCase::class)($battle->getEntityIdMakeAMove());

        $this->sendAMessageToAllGroupMembers
        (
            $group,
            "{$entity->getName()} завершает ход \n"
            . "Следующий ходит {$entityMakingNextMove->getName()}",
            function (TelegraphChat $telegraphChat, User $user) {
                $this->sendCurrentMenu($user, $telegraphChat);
            }
        );

        $this->reply("{$entity->getName()} завершает ход");

        $this->setMainMenu($user);
    }

    private function setModels(): void
    {
        $this->user = app(GetByChatIdUseCase::class)($this->getChatId());

        /** @var Group $group */
        $this->group = app(GetGroupByMemberIdUseCase::class)($this->user->getId());
        if ($this->group == null) {
            $this->group = app(GetGroupByOwnerIdUseCase::class)($this->user->getId());
        }

        /** @var Battle $battle */
        $battle = app(GetByGroupIdUseCase::class)($this->group->getId());

        $this->entityPerformingAnAction = app(GetUseCase::class)($battle->getEntityIdMakeAMove());
        $this->entityOnWhichTheActionIsPerformed = app(GetUseCase::class)((int)$this->data->get('id'));
    }
}

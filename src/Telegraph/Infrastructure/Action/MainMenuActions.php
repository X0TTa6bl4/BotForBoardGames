<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use src\Battle\Application\UseCase\CreateUseCase;
use src\Battle\Application\UseCase\DeletedBattleByGroupIdUseCase;
use src\Battle\Domain\Entity\Battle;
use src\EntityCard\Application\UseCase\EntityCard\GetUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\Group;
use src\Telegraph\Infrastructure\Handler;
use src\Telegraph\Infrastructure\Traits\SendAMessageToAllGroupMembersTrait;
use src\User\Application\UseCase\GetByChatIdUseCase;
use src\User\Application\UseCase\Request\UpdateMenuStateRequest;
use src\User\Application\UseCase\UpdateMenuStateUseCase;
use src\User\Domain\Entity\User;

/**
 * @mixin Handler
 */
trait MainMenuActions
{
    use SendAMessageToAllGroupMembersTrait;

    public function showEntity(): void
    {
        $entity = app(GetUseCase::class)((int)$this->data->get('id'));
        $this->showEntityCard($entity);
        $this->currentMenu();
    }

    public function showEntities(): void
    {
        $user = $this->getUser();
        $user->setMenuState('showEntities');
        $this->updateUser($user);
        $this->currentMenu();
    }

    public function showAllEntities(): void
    {
        $user = $this->getUser();
        $user->setMenuState('showAllEntities');
        $this->updateUser($user);
        $this->currentMenu();
    }

    private function showEntityCard(EntityCard $entity): void
    {
        $this->chat->message($this->convertEntityCardToTextForDisplay($entity))->send();
    }

    public function createEntityMain(): void
    {
        $user = app(GetByChatIdUseCase::class)($this->getChatId());
        $user->setMenuState('createEntityMain');
        app(UpdateMenuStateUseCase::class)(
            new UpdateMenuStateRequest(
                id: $user->getId(),
                state: $user->getMenuState()
            )
        );

        $this->currentMenu();
    }

    public function startBattle(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        /** @var Group $group */
        $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());

        try {
            /** @var Battle $battle */
            $battle = app(CreateUseCase::class)($group->getId());
        } catch (\Exception $e) {
            $this->chat->message($e->getMessage())->send();
            $this->currentMenu();
            return;
        }

        $this->sendAMessageToAllGroupMembers($group, "Battle started!");

        $this->currentMenu();
    }

    public function stopBattle(): void
    {
        $user = $this->getUser();
        $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());
        app(DeletedBattleByGroupIdUseCase::class)($group->getId());

        $this->sendAMessageToAllGroupMembers($group, "Battle stop!");
        //TODO - добавить очистку entities
        $this->currentMenu();
    }

    public function getPublicId(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        /** @var Group $user */
        $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());

        $this->chat->message("Public id: <code>{$group->getPublicId()}</code>")->send();
        $this->currentMenu();
    }

    public function help(): void
    {
        $this->chat->message("Это мир настольных игр я уверен ты придумаешь что-нибудь сам")->send();
        $this->currentMenu();
    }

    public function goToMainMenu(): void
    {
        $user = $this->getUser();
        $this->setMainMenu($user);
        $this->currentMenu();
    }

    private function convertEntityCardToTextForDisplay(EntityCard $entity): string
    {
        return "name: {$entity->getName()} \n"
            . "lvl: {$entity->getLvl()}\n"
            . "hp: {$entity->getHealthPoints()}/{$entity->getMaxHealthPoints()}\n"
            . "power: {$entity->getPower()}\n"
            . "initiative: {$entity->getInitiative()}\n"
            . "intelligence: {$entity->getIntelligence()}\n"
            . "protection: {$entity->getProtection()}\n";
    }

}

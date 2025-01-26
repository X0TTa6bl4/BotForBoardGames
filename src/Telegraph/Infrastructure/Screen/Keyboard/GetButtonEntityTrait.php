<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use src\EntityCard\Application\UseCase\Group\GetGroupByMemberIdUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\Group;
use src\User\Domain\Entity\User;

trait GetButtonEntityTrait
{

    public function showAllEntity(User $user, string $action): Keyboard
    {
        /** @var Group $group */
        $group = app(GetGroupByMemberIdUseCase::class)($user->getId());
        if ($group === null) {
            $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());
        }

        $entities = collect($group->getAllEntities())->sortByDesc(function (EntityCard $entity) {
            return $entity->getInitiative();
        });

        foreach ($entities as $entity) {
            $buttons[] = $this->getEntityButton($entity, $action);
        }
        $buttons[] = Button::make('Вернуться в главное меню')->action('goToMainMenu');
        return Keyboard::make()->buttons($buttons);
    }

    public function getEntityButton(EntityCard $entity, $action): Button
    {
        return Button::make(
            $entity->getName() . " hp:{$entity->getHealthPoints()}/{$entity->getMaxHealthPoints()}"
        )->action($action)->param('id', $entity->getId());
    }
}

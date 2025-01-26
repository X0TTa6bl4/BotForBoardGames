<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard\MainMenu;

use src\Battle\Application\UseCase\GetByGroupIdUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByMemberIdUseCase;
use src\EntityCard\Domain\Entity\User;

/**
 * @mixin MainMenu
 */
trait UserMenuTrait
{
    private function addButtonsForUser(User $user): void
    {
        $this->addButtons([]);
        $group = app(GetGroupByMemberIdUseCase::class)($user->getId());
        if (($this->isHasBattle)($group->getId())) {
            $battle = app(GetByGroupIdUseCase::class)($group->getId());
            $this->addActionBattleButtons($user, $battle);
        }
    }
}

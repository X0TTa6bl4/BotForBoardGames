<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use src\Telegraph\Infrastructure\Handler;

/**
 * @mixin Handler
 */
trait BattleActions
{
    public function showAllEntitiesForAttack(): void
    {
        $user = $this->getUser();
        $user->setMenuState('showAllEntitiesForAttack');
        $this->updateUser($user);
        $this->currentMenu();
    }

    public function showAllEntitiesForHeal(): void
    {
        $user = $this->getUser();
        $user->setMenuState('showAllEntitiesForHeal');
        $this->updateUser($user);
        $this->currentMenu();
    }
}

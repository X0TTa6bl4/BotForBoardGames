<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard\MainMenu;

use DefStudio\Telegraph\Keyboard\Button;
use src\Battle\Domain\Entity\Battle;
use src\EntityCard\Domain\Entity\User;

/**
 * @mixin MainMenu
 */
trait BattleButtonsTrait
{
    public function addActionBattleButtons(User $user, Battle $battle): void
    {
        foreach ($user->getEntities() as $entity) {
            if ($entity->getId() === $battle->getEntityIdMakeAMove()) {
                $this->addButtons([
                    'attack' => Button::make('Атаковать')->action('showAllEntitiesForAttack'),
                    'heal' => Button::make('Лечить')->action('showAllEntitiesForHeal'),
                    'endYourTurn' => Button::make('Закончить ход')->action('endYourTurn'),
                ]);
                break;
            }
        }
    }
}

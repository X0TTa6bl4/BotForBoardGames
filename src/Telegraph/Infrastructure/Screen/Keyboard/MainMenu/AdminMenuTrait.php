<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard\MainMenu;

use DefStudio\Telegraph\Keyboard\Button;
use src\Battle\Application\Action\IsHasBattleContract;
use src\Battle\Application\UseCase\GetByGroupIdUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;
use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Entity\User;

/**
 * @mixin MainMenu
 */
trait AdminMenuTrait
{
    private function addButtonsForAdmin(User $user): void
    {
        $this->addButtons([
            'id' => Button::make('Получить id мира')->action('getPublicId'),
            'entity' => Button::make('Создать существо')->action('createEntityMain'),
        ]);

        $group = app(GetGroupByOwnerIdUseCase::class)($user->getId());

        $this->addBattleButtons($group, $user);
    }

    protected function addBattleButtons(Group $group, User $user): void
    {
        if (app(IsHasBattleContract::class)($group->getId())) {
            $battle = app(GetByGroupIdUseCase::class)($group->getId());

            $this->addActionBattleButtons($user, $battle);
            $this->addButtons([
                'endYourTurn' => Button::make('Закончить ход')->action('endYourTurn'),
                'battle' => Button::make('Остановить бой')->action('stopBattle'),
            ]);
        } else {
            $this->addButtons([
                'battle' => Button::make('Начать бой!')->action('startBattle'),
            ]);
        }
    }
}

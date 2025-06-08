<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard\MainMenu;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use src\Battle\Application\Action\IsHasBattleContract;
use src\EntityCard\Application\Action\IsThereAGroupOwnedByTheUserContract;
use src\EntityCard\Application\UseCase\User\GetByIdUseCase as GetEntityCardUserUseCase;
use src\EntityCard\Domain\Entity\User as EntityCardUser;
use src\Telegraph\Infrastructure\Screen\Keyboard\KeyboardContract;
use src\User\Application\UseCase\Response\UserResponse;

class MainMenu implements KeyboardContract
{
    use AdminMenuTrait, BattleButtonsTrait, UserMenuTrait;

    private array $buttons;

    public function __construct(
        private readonly IsThereAGroupOwnedByTheUserContract $isThereAGroupOwnedByTheUser,
        private readonly IsHasBattleContract $isHasBattle,
        private readonly GetEntityCardUserUseCase $getEntityCardUserUseCase,
    ) {
        $this->buttons = [];
    }

    public function __invoke(UserResponse $user): Keyboard
    {
        $entityCardUser = ($this->getEntityCardUserUseCase)($user->id);

        if (($this->isThereAGroupOwnedByTheUser)($user->id)) {
            $this->addButtonsForAdmin($entityCardUser);
        } else {
            $this->addButtonsForUser($entityCardUser);
        }
        $this->addButtonShowEntityCard($entityCardUser);
        $this->addCommonButtons();

        return Keyboard::make()->buttons($this->buttons);
    }

    public function addCommonButtons(): void
    {
        $this->addButtons([
            'showAllEntities' => Button::make('Показать всех персонажей')->action('showAllEntities'),
            'help' => Button::make('Помощь')->action('help'),
        ]);
    }

    private function addButtonShowEntityCard(EntityCardUser $user): void
    {
        if (count($user->getEntities()) > 1) {
            $this->addButtons([
                'showCard' => Button::make('Показать карточки персонажей')->action('showEntities'),
            ]);
        } elseif (count($user->getEntities()) > 0) {
            $this->addButtons([
                'showCards' => Button::make('Показать карточку персонажа')
                    ->action('showEntity')
                    ->param('id', $user->getEntities()[0]->getId()),
            ]);
        } else {
            $this->addButtons([
                'entity' => Button::make('Создать персонажа')->action('createEntityMain'),
            ]);
        }
    }

    private function addButtons(array $buttons): void
    {
        $this->buttons = array_merge($this->buttons, $buttons);
    }
}

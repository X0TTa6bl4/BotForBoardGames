<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use src\EntityCard\Application\UseCase\User\GetByIdUseCase;
use src\EntityCard\Domain\Entity\User as EntityCardUser;
use src\User\Domain\Entity\User;

class ShowEntitiesMenu implements KeyboardContract
{
    public function __invoke(User $user): Keyboard
    {
        /** @var EntityCardUser $entityCardUser */
        $entityCardUser = app(GetByIdUseCase::class)($user->getId());
        $buttons = [];
        foreach ($entityCardUser->getEntities() as $entity) {
            $buttons[] = Button::make($entity->getName())->action('showEntity')->param('id', $entity->getId());
        }
        $buttons[] = Button::make('Вернуться в главное меню')->action('goToMainMenu');
        return Keyboard::make()->buttons($buttons);
    }
}

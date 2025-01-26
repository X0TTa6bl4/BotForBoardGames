<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use src\User\Domain\Entity\User;

class CreateEntityMainMenu implements KeyboardContract
{
    public function __invoke(User $user): Keyboard
    {
        return Keyboard::make()->buttons([
            Button::make('Создать случайное существо')->action('createRandomEntity'),
            Button::make('Создать персонажа с параметрами')->action('createEntityWithParams'),
            Button::make('Вернуться в главное меню')->action('fromCreateEntityGoToMainMenu'),
        ]);
    }
}

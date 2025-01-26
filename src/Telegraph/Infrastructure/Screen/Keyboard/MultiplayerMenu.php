<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use src\User\Domain\Entity\User;

class MultiplayerMenu implements KeyboardContract
{
    public function __invoke(User $user): Keyboard
    {
        return Keyboard::make()->row([
            Button::make('Создать мир')->action('createWorld'),
            Button::make('Присоединиться')->action('joinWorld'),
        ]);
    }
}

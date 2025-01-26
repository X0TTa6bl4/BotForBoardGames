<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Keyboard;
use src\User\Domain\Entity\User;

class ShowAllEntitiesMenu implements KeyboardContract
{
    use GetButtonEntityTrait;

    public function __invoke(User $user): Keyboard
    {
       return $this->showAllEntity($user, 'showEntity');
    }
}

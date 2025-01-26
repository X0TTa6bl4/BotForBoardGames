<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Keyboard;
use src\User\Domain\Entity\User;

interface KeyboardContract
{
    public function __invoke(User $user): Keyboard;

}

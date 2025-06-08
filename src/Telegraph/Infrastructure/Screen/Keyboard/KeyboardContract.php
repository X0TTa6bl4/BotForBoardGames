<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Keyboard;

use DefStudio\Telegraph\Keyboard\Keyboard;
use src\User\Application\UseCase\Response\UserResponse;

interface KeyboardContract
{
    public function __invoke(UserResponse $user): Keyboard;

}

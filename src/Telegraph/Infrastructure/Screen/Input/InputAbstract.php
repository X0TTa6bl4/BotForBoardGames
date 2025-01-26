<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\Telegraph\Infrastructure\Traits\UpdateUserTrait;
use src\User\Domain\Entity\User;

abstract class InputAbstract
{
    use UpdateUserTrait;

    abstract public function __invoke(Stringable $text, User $user): void;
}

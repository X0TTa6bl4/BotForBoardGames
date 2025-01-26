<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\UpdatePowerRequest;
use src\EntityCard\Application\UseCase\EntityCard\UpdatePowerUseCase;
use src\User\Domain\Entity\User;

class SetPower extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(UpdatePowerUseCase::class)(
            new UpdatePowerRequest(
                userId: $user->getEntityIdInteraction(),
                power: (int)(string)$text,
            )
        );
        $user->setMenuState('setInitiative');
        $this->updateUser($user);
    }
}

<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateNameRequest;
use src\EntityCard\Application\UseCase\EntityCard\UpdateNameUseCase;
use src\User\Domain\Entity\User;

class SetName extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(UpdateNameUseCase::class)(
            new UpdateNameRequest(
                userId: $user->getEntityIdInteraction(),
                name: (string)$text
            )
        );
        $user->setMenuState('setHealthPoints');
        $this->updateUser($user);
    }
}

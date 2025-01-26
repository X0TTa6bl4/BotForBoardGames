<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateProtectionRequest;
use src\EntityCard\Application\UseCase\EntityCard\UpdateProtectionUseCase;
use src\User\Domain\Entity\User;

class SetProtection extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(UpdateProtectionUseCase::class)(
            new UpdateProtectionRequest(
                userId: $user->getEntityIdInteraction(),
                protection: (int)(string)$text,
            )
        );
        $user->setMenuState('mainMenu')->setEntityIdInteraction(null);
        $this->updateUser($user);
    }
}

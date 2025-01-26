<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateInitiativeRequest;
use src\EntityCard\Application\UseCase\EntityCard\UpdateInitiativeUseCase;
use src\User\Domain\Entity\User;

class SetInitiative extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(UpdateInitiativeUseCase::class)(
            new UpdateInitiativeRequest(
                userId: $user->getEntityIdInteraction(),
                initiative: (int)(string)$text,
            )
        );
        $user->setMenuState('setIntelligence');
        $this->updateUser($user);
    }
}

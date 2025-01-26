<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\UpdateIntelligenceRequest;
use src\EntityCard\Application\UseCase\EntityCard\UpdateIntelligenceUseCase;
use src\User\Domain\Entity\User;

class SetIntelligence extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(UpdateIntelligenceUseCase::class)(
            new UpdateIntelligenceRequest(
                userId: $user->getEntityIdInteraction(),
                intelligence: (int)(string)$text,
            )
        );
        $user->setMenuState('setProtection');
        $this->updateUser($user);
    }
}

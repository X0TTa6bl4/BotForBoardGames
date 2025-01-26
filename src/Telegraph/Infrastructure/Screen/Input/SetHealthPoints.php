<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\EntityCard\Request\SetHealthPointsRequest;
use src\EntityCard\Application\UseCase\EntityCard\SetHealthPointsUseCase;
use src\User\Domain\Entity\User;

class SetHealthPoints extends InputAbstract
{
    public function __invoke(Stringable $text, User $user): void
    {
        app(SetHealthPointsUseCase::class)(
            new SetHealthPointsRequest(
                userId: $user->getEntityIdInteraction(),
                healthPoints: (int)(string)$text,
            )
        );
        $user->setMenuState('setPower');
        $this->updateUser($user);
    }
}

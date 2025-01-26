<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use src\User\Application\UseCase\GetByIdUseCase;
use src\User\Application\UseCase\Request\UpdateRequest;
use src\User\Application\UseCase\UpdateUseCase;

class TestController extends Controller
{
    public function test(Request $request)
    {
        /** @var \src\User\Domain\Entity\User $user */
        $user = app(GetByIdUseCase::class)(5);

        dump(
            $user,
            $user->setEntityIdInteraction(null)
        );
        app(UpdateUseCase::class)(
            new UpdateRequest(
                id: $user->getId(),
                name: $user->getName(),
                state: $user->getMenuState(),
                entityIdInteraction: $user->getEntityIdInteraction()
            )
        );
    }
}

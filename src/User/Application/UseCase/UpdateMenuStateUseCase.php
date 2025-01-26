<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Application\UseCase\Request\UpdateMenuStateRequest;
use src\User\Domain\Repository\UserRepositoryContract;

class UpdateMenuStateUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function __invoke(UpdateMenuStateRequest $request): void
    {
        $user = $this->userRepository->getById($request->id);
        $user->setMenuState($request->state);
        $this->userRepository->update($user);
    }
}

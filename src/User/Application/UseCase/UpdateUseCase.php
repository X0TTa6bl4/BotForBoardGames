<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Application\UseCase\Request\UpdateRequest;
use src\User\Domain\Repository\UserRepositoryContract;

class UpdateUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function __invoke(UpdateRequest $request): void
    {
        $user = $this->userRepository->getById($request->id);
        $user->setName($request->name)->setMenuState($request->state)->setEntityIdInteraction($request->entityIdInteraction);
        $this->userRepository->update($user);
    }
}

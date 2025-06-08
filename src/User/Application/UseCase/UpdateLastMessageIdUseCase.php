<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Application\UseCase\Request\UpdateLastMessageIdRequest;
use src\User\Domain\Repository\UserRepositoryContract;

class UpdateLastMessageIdUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    ) {
    }

    public function __invoke(UpdateLastMessageIdRequest $request): void
    {
        $user = $this->userRepository->getById($request->id);
        $user->setMessageId($request->lastMessageId);
        $this->userRepository->update($user);
    }
}

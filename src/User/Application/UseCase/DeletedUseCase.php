<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Domain\Repository\UserRepositoryContract;

class DeletedUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function __invoke(int $id): void
    {
        $this->userRepository->deleted($id);
    }
}

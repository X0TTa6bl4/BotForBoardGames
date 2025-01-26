<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\User;

use src\EntityCard\Domain\Entity\User;
use src\EntityCard\Domain\Repository\UserRepositoryContract;

class GetByIdUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function __invoke(int $id): User
    {
        return $this->userRepository->getById($id);
    }
}

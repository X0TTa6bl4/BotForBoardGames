<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\User;

use src\EntityCard\Domain\Entity\User;
use src\EntityCard\Domain\Repository\UserRepositoryContract;

class GetByChatIdUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    )
    {
    }

    public function __invoke(int $chatId): User
    {
        return $this->userRepository->getByChatId($chatId);
    }
}

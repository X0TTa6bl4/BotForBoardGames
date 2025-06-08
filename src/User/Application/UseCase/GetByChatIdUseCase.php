<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Application\UseCase\Response\MessageIdResponse;
use src\User\Application\UseCase\Response\UserResponse;
use src\User\Domain\Repository\UserRepositoryContract;

class GetByChatIdUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    ) {
    }

    public function __invoke(int $chatId): UserResponse
    {
        $user = $this->userRepository->getByChatId($chatId);
        return new UserResponse(
            id: $user->getId(),
            name: $user->getName(),
            chatId: $chatId,
            menuState: $user->getMenuState(),
            messageId: $user->getMessageId(),
        );
    }
}

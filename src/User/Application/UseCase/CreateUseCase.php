<?php

declare(strict_types=1);

namespace src\User\Application\UseCase;

use src\User\Application\Builder\UserBuilder;
use src\User\Application\UseCase\Request\CreateRequest;
use src\User\Domain\Entity\User;
use src\User\Domain\Repository\UserRepositoryContract;

class CreateUseCase
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository,
        private readonly UserBuilder            $userBuilder
    )
    {
    }

    public function __invoke(CreateRequest $request): User
    {
        if($this->userRepository->isExistsByChatId($request->chatId)) {
            throw new \Exception('User already exists');
        }
        return $this->userRepository->create(
            $this->userBuilder->fromCreate($request)
        );
    }
}

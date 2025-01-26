<?php

declare(strict_types=1);

namespace src\EntityCard\Application\UseCase\Group;

use src\EntityCard\Application\UseCase\Group\Request\AddUserRequest;
use src\EntityCard\Domain\Repository\GroupRepositoryContract;
use src\EntityCard\Domain\Repository\UserRepositoryContract;

class AddUserUseCase
{
    public function __construct(
        private readonly GroupRepositoryContract $groupRepository,
        private readonly UserRepositoryContract  $userRepository
    )
    {
    }

    public function __invoke(AddUserRequest $request): void
    {
        $user = $this->userRepository->getByChatId($request->chatId);
        $group = $this->groupRepository->getByPublicId($request->publicGroupId);
        if ($group === null) {
            throw new \Exception('Group not found');
        }
        $group->addUser($user);
        $this->groupRepository->update($group);
    }
}

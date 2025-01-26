<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Screen\Input;

use Illuminate\Support\Stringable;
use src\EntityCard\Application\UseCase\Group\AddUserUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByMemberIdUseCase;
use src\EntityCard\Application\UseCase\Group\Request\AddUserRequest;
use src\Telegraph\Infrastructure\Traits\SendAMessageToAllGroupMembersTrait;
use src\User\Domain\Entity\User;

class InputPublicId extends InputAbstract
{
    use SendAMessageToAllGroupMembersTrait;

    public function __invoke(Stringable $text, User $user): void
    {
        app(AddUserUseCase::class)(
            new AddUserRequest(
                publicGroupId: (string)$text,
                chatId: $user->getChatId()
            )
        );
        $user->setMenuState('mainMenu');
        $this->updateUser($user);
        $group = app(GetGroupByMemberIdUseCase::class)($user->getId());
        $this->sendAMessageToAllGroupMembers(
            $group,
            "Пользователь {$user->getName()} присоединился к миру"
        );
    }
}

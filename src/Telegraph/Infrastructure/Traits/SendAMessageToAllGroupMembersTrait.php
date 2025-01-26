<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Traits;

use DefStudio\Telegraph\Models\TelegraphChat;
use src\EntityCard\Domain\Entity\Group;
use src\User\Application\UseCase\GetByIdUseCase;

trait SendAMessageToAllGroupMembersTrait
{
    public function sendAMessageToAllGroupMembers(Group $group, string $message, callable $function = null): void
    {
        $users = $group->getAllUsers();
        foreach ($users as $userEntityCard) {
            /** @var TelegraphChat $telegraphChat */
            $telegraphChat = TelegraphChat::query()->where('chat_id', $userEntityCard->getChatId())->first();

            $telegraphChat->message($message)->send();

            if ($function !== null) {
                $user = app(GetByIdUseCase::class)($userEntityCard->getId());
                $function($telegraphChat, $user);
            }
        }
    }
}

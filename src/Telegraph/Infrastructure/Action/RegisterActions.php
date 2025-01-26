<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure\Action;

use src\Telegraph\Infrastructure\Handler;
use src\User\Application\UseCase\CreateUseCase as UserCreateUseCase;
use src\User\Application\UseCase\Request\CreateRequest as UserCreateRequest;

/**
 * @mixin Handler
 */
trait RegisterActions
{
    public function start(): void
    {
        try {
            app(UserCreateUseCase::class)(
                new UserCreateRequest(
                    name: $this->message->from()->username() ?? $this->message->from()->firstName(),
                    chatId: $this->message->from()->id()
                )
            );
        } catch (\Exception $e) {
            $this->reply($e->getMessage());
            $this->menu();
            return;
        }
        $this->menu();
    }
}

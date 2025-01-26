<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Stringable;
use src\Telegraph\Infrastructure\Action\BattleActions;
use src\Telegraph\Infrastructure\Action\CreateEntityMainActions;
use src\Telegraph\Infrastructure\Action\EntityInteractionActions;
use src\Telegraph\Infrastructure\Action\MainMenuActions;
use src\Telegraph\Infrastructure\Action\MultiplayerMenuActions;
use src\Telegraph\Infrastructure\Action\RegisterActions;
use src\Telegraph\Infrastructure\Screen\Keyboard\KeyboardContract;
use src\Telegraph\Infrastructure\Traits\SendAMessageToAllGroupMembersTrait;
use src\Telegraph\Infrastructure\Traits\UpdateUserTrait;
use src\User\Application\UseCase\GetByChatIdUseCase;
use src\User\Domain\Entity\User;

class Handler extends WebhookHandler
{
    use MultiplayerMenuActions, RegisterActions, CreateEntityMainActions, MainMenuActions, BattleActions, EntityInteractionActions;
    use UpdateUserTrait, SendAMessageToAllGroupMembersTrait;

    public function currentMenu(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        $menu = $this->sendCurrentMenu($user);
        $this->reply($menu->getMessage());
    }

    public function menu(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        $this->sendCurrentMenu($user);
    }

    protected function sendCurrentMenu(User $user, TelegraphChat $telegraphChat = null): Menu
    {
        $menu = $this->getMenu($user->getMenuState());

        if ($menu->getType() === 'keyboard') {
            /** @var KeyboardContract $handler */
            $handler = app($menu->getHandler());
            $this->getTelegraphChat($telegraphChat)->message($menu->getMessage())->keyboard($handler($user))->send();
        } else {
            $this->getTelegraphChat($telegraphChat)->message($menu->getMessage())->send();
        }
        return $menu;
    }

    protected function getTelegraphChat(?TelegraphChat $telegraphChat): TelegraphChat
    {
        if ($telegraphChat === null) {
            return $this->chat;
        }

        return $telegraphChat;
    }

    protected function handleChatMessage(Stringable $text): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->message->from()->id());

        $menu = $this->getMenu($user->getMenuState());
        $handler = app($menu->getHandler());
        try {
            $handler($text, $user);
        } catch (\Exception $e) {
            $this->reply($e->getMessage());
        }

        $this->menu();
    }

    protected function getChatId(): int
    {
        return (int)$this->chat->chat_id;
    }

    protected function getMenu(string $menuState): Menu
    {
        $menuArray = config('menu.' . $menuState);
        return new Menu(
            type: $menuArray['type'],
            message: $menuArray['message'],
            handler: $menuArray['handler']
        );
    }

    protected function getUser(): User
    {
        return app(GetByChatIdUseCase::class)($this->getChatId());
    }

    protected function setMainMenu(User $user): void
    {
        $user->setMenuState('mainMenu');
        $this->updateUser($user);
    }
}

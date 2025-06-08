<?php

declare(strict_types=1);

namespace src\Telegraph\Infrastructure;

use DefStudio\Telegraph\Exceptions\TelegramWebhookException;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
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
use src\User\Application\UseCase\Request\UpdateLastMessageIdRequest;
use src\User\Application\UseCase\Response\UserResponse;
use src\User\Application\UseCase\UpdateLastMessageIdUseCase;
use src\User\Domain\Entity\User;

class Handler extends WebhookHandler
{
    use MultiplayerMenuActions, RegisterActions, CreateEntityMainActions, MainMenuActions, BattleActions, EntityInteractionActions;
    use UpdateUserTrait, SendAMessageToAllGroupMembersTrait;

    public function handleUnknownCommand(Stringable $text): void
    {
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        if ($text->value() === '/test') {
            $this->chat->deleteMessages([
                $user->messageId,
                $this->messageId,
            ])->send();

            $response = $this->chat
                ->message('test')
                ->keyboard(
                    KeyBoard::make()
                        ->buttons([
                            Button::make('test')->action('test'),
                        ])
                )->send();

            app(UpdateLastMessageIdUseCase::class)(
                new UpdateLastMessageIdRequest(
                    $user->id,
                    $response->telegraphMessageId()
                )
            );
        } else {
            $this->reply('Unknown command');
        }
    }

    /**
     * @throws TelegramWebhookException
     */
    protected function handleCallbackQuery(): void
    {
        $this->extractCallbackQueryData();

        if (config('telegraph.debug_mode', config('telegraph.webhook.debug'))) {
            Log::debug('Telegraph webhook callback', $this->data->toArray());
        }

        /** @var string $action */
        $action = $this->callbackQuery?->data()->get('action') ?? '';

        $menu = config('menu.' . $action);

        if ($menu != null) {
            $this->reply('test action callback');
            return;
        }

        if (!$this->canHandle($action)) {
            report(TelegramWebhookException::invalidAction($action));
            $this->reply(__('telegraph::errors.invalid_action'));

            return;
        }

        App::call([$this, $action], $this->data->toArray());
    }

    public function currentMenu(): void
    {
        /** @var User $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        $menu = $this->sendCurrentMenu($user);
        $this->reply($menu->getMessage());
    }

    public function menu(): void
    {
        /** @var UserResponse $user */
        $user = app(GetByChatIdUseCase::class)($this->getChatId());

        $this->sendCurrentMenu($user);
    }

    protected function sendCurrentMenu(UserResponse $user, TelegraphChat $telegraphChat = null): Menu
    {
        $menu = $this->getMenu($user->menuState);

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
        $menuArray = config('menu.'.$menuState);
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

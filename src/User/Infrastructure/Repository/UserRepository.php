<?php

declare(strict_types=1);

namespace src\User\Infrastructure\Repository;

use App\Models\User as UserEloquentModel;
use App\Models\UserEntityInteraction;
use Illuminate\Support\Str;
use src\User\Application\Builder\UserBuilder;
use src\User\Domain\Entity\User;
use src\User\Domain\Repository\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserBuilder $userBuilder
    )
    {
    }

    public function create(User $user): User
    {
        /** @var UserEloquentModel $userEloquentModel */
        $userEloquentModel = UserEloquentModel::query()->create([
                'name' => $user->getName(),
                'chat_id' => $user->getChatId(),
                'email' => Str::uuid() . '@email.com',
                'password' => bcrypt(Str::random(10)),
                'menu_state' => $user->getMenuState(),
            ]
        );

        //TODO - проверить как регистрируется пользователь
        return $this->userBuilder->fromEloquentModel($userEloquentModel);
    }

    public function update(User $user): bool
    {
        $userEloquentModel = UserEloquentModel::query()
            ->find($user->getId())
            ->update([
                'name' => $user->getName(),
                'menu_state' => $user->getMenuState(),
                'message_id' => $user->getMessageId()
            ]);

        if($user->getEntityIdInteraction() === null){
            UserEntityInteraction::query()->where('user_id', $user->getId())->delete();
        } else {
            UserEntityInteraction::query()->updateOrCreate(
                ['user_id' => $user->getId()],
                ['entity_id' => $user->getEntityIdInteraction()]
            );
        }

        return $userEloquentModel;
    }

    public function getById(int $userId): User
    {
        /** @var UserEloquentModel $userEloquentModel */
        $userEloquentModel = UserEloquentModel::query()->with('userEntityInteraction')->find($userId);

        return $this->userBuilder->fromEloquentModel($userEloquentModel);
    }

    public function deleted(int $userId): void
    {
        UserEloquentModel::query()->find($userId)->delete();
    }

    public function getByChatId(int $chatId): User
    {
        /** @var UserEloquentModel $userEloquentModel */
        $userEloquentModel = UserEloquentModel::query()->where('chat_id', $chatId)->first();

        return $this->userBuilder->fromEloquentModel($userEloquentModel);
    }

    public function isExistsByChatId(int $chatId): bool
    {
        return UserEloquentModel::query()->where('chat_id', $chatId)->exists();
    }
}

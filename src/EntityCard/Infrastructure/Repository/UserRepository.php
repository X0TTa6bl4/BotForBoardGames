<?php

declare(strict_types=1);

namespace src\EntityCard\Infrastructure\Repository;

use App\Models\User as UserEloquentModel;
use Illuminate\Support\Str;
use src\EntityCard\Application\Builder\UserBuilder;
use src\EntityCard\Domain\Entity\User;
use src\EntityCard\Domain\Repository\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(
        private readonly UserBuilder $userBuilder
    )
    {
    }

    public function update(User $user): bool
    {
        $userEloquentModel = UserEloquentModel::query()->find($user->getId())->update([
            'name' => $user->getName(),
        ]);

        return $userEloquentModel;
    }

    public function getById(int $id): User
    {
        /** @var UserEloquentModel $userEloquentModel */
        $userEloquentModel = UserEloquentModel::query()->find($id);

        return $this->userBuilder->fromEloquentModel($userEloquentModel);
    }

    public function deleted(int $id): void
    {
        UserEloquentModel::query()->find($id)->delete();
    }

    public function getByChatId(int $chatId): User
    {
        /** @var UserEloquentModel $userEloquentModel */
        $userEloquentModel = UserEloquentModel::query()->where('chat_id', $chatId)->first();

        return $this->userBuilder->fromEloquentModel($userEloquentModel);
    }
}

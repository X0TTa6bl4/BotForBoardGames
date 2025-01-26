<?php

declare(strict_types=1);

namespace src\User\Domain\Repository;

use src\User\Domain\Entity\User;

interface UserRepositoryContract
{
    public function create(User $user): User;

    public function update(User $user): bool;

    public function getById(int $userId): User;

    public function getByChatId(int $chatId): User;

    public function deleted(int $userId): void;

    public function isExistsByChatId(int $chatId): bool;
}

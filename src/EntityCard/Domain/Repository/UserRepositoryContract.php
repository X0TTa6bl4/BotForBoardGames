<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Repository;

use src\EntityCard\Domain\Entity\User;

interface UserRepositoryContract
{
    public function update(User $user): bool;

    public function getById(int $id): User;

    public function deleted(int $id): void;

    public function getByChatId(int $chatId): User;
}

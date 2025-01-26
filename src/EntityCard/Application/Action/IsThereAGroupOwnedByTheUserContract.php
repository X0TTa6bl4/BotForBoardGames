<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Action;

interface IsThereAGroupOwnedByTheUserContract
{
    public function __invoke(int $userId): bool;
}

<?php

declare(strict_types=1);

namespace src\Battle\Application\Action;

interface IsHasBattleContract
{
    public function __invoke(int $groupId): bool;
}

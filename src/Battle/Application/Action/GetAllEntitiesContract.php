<?php

declare(strict_types=1);

namespace src\Battle\Application\Action;

interface GetAllEntitiesContract
{
    public function __invoke(int $groupId): array;
}

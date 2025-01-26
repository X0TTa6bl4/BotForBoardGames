<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Rule;

use src\EntityCard\Domain\Entity\Group;

interface IsItPossibleToCreateAnEntityRuleContract
{
    public function __invoke(Group $group, int $userId): bool;
}

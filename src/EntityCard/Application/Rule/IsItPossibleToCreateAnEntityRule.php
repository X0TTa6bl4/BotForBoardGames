<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Rule;

use src\EntityCard\Domain\Entity\Group;
use src\EntityCard\Domain\Rule\IsItPossibleToCreateAnEntityRuleContract;

class IsItPossibleToCreateAnEntityRule implements IsItPossibleToCreateAnEntityRuleContract
{
    /**
     * @throws \Exception
     */
    public function __invoke(Group $group, int $userId): bool
    {
        $user = $group->findUserById($userId);
        $userEntities = $user->getEntities();

        return $group->getOwnerId() === $userId || count($userEntities) === 0;
    }
}

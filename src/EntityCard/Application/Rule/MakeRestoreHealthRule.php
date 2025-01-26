<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Rule;

use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\RestoreHealthValueObject;
use src\EntityCard\Domain\Rule\MakeRestoreHealthRuleContract;

class MakeRestoreHealthRule implements MakeRestoreHealthRuleContract
{

    public function __invoke(EntityCard $entityCard): RestoreHealthValueObject
    {
        return new RestoreHealthValueObject($entityCard->getIntelligence() + $entityCard->getPower());
    }
}

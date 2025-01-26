<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Rule;

use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\HealthPointsValueObject;
use src\EntityCard\Domain\Entity\ValueObject\RestoreHealthValueObject;
use src\EntityCard\Domain\Rule\TakeRestoreHealthRuleContract;

class TakeRestoreHealthRule implements TakeRestoreHealthRuleContract
{

    public function __invoke(EntityCard $entityCard, RestoreHealthValueObject $restoreHealth): int
    {
        $restoreHealth = $restoreHealth->getValue();

        $entityCard->setHealthPoints(
            new HealthPointsValueObject(
                min($entityCard->getHealthPoints() + $restoreHealth, $entityCard->getMaxHealthPoints()),
                $entityCard->getMaxHealthPoints()
            )
        );

        return $restoreHealth;
    }
}

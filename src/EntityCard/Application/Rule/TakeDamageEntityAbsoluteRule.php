<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Rule;

use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\DamageValueObject;
use src\EntityCard\Domain\Entity\ValueObject\HealthPointsValueObject;
use src\EntityCard\Domain\Rule\TakeDamageEntityRuleContract;

class TakeDamageEntityAbsoluteRule implements TakeDamageEntityRuleContract
{

    public function __invoke(EntityCard $entityCard, DamageValueObject $damage): int
    {
        $damage = $damage->getValue();

        $totalDamage = max($damage - $entityCard->getProtection(), 0);
        $newHealthPoints = $entityCard->getHealthPoints() - $totalDamage;

        $entityCard->setHealthPoints(
            new HealthPointsValueObject(
                max($newHealthPoints, 0),
                $entityCard->getMaxHealthPoints()
            )
        );

        return $totalDamage;
    }
}

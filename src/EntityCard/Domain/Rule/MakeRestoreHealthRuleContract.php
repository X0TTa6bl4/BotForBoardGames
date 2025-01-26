<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Rule;

use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\RestoreHealthValueObject;

interface MakeRestoreHealthRuleContract
{
    public function __invoke(EntityCard $entityCard): RestoreHealthValueObject;
}

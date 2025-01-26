<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity;

use src\EntityCard\Domain\Entity\ValueObject\DamageValueObject;
use src\EntityCard\Domain\Entity\ValueObject\HealthPointsValueObject;
use src\EntityCard\Domain\Entity\ValueObject\IdValueObject;
use src\EntityCard\Domain\Entity\ValueObject\InitiativeValueObject;
use src\EntityCard\Domain\Entity\ValueObject\IntelligenceValueObject;
use src\EntityCard\Domain\Entity\ValueObject\LvlValueObject;
use src\EntityCard\Domain\Entity\ValueObject\NameValueObject;
use src\EntityCard\Domain\Entity\ValueObject\PowerValueObject;
use src\EntityCard\Domain\Entity\ValueObject\ProtectionValueObject;
use src\EntityCard\Domain\Entity\ValueObject\RestoreHealthValueObject;
use src\EntityCard\Domain\Rule\MakeDamageEntityRuleContract;
use src\EntityCard\Domain\Rule\MakeRestoreHealthRuleContract;
use src\EntityCard\Domain\Rule\TakeDamageEntityRuleContract;
use src\EntityCard\Domain\Rule\TakeRestoreHealthRuleContract;

class EntityCard
{
    private ?IdValueObject $id;
    private IdValueObject $userId;
    private NameValueObject $name;
    private HealthPointsValueObject $healthPoints;
    private PowerValueObject $power;
    private InitiativeValueObject $initiative;
    private IntelligenceValueObject $intelligence;
    private LvlValueObject $lvl;
    private ProtectionValueObject $protection;

    public function __construct(
        ?IdValueObject          $id,
        NameValueObject         $name,
        IdValueObject           $userId,
        HealthPointsValueObject $healthPoints,
        PowerValueObject        $power,
        InitiativeValueObject   $initiative,
        IntelligenceValueObject $intelligence,
        LvlValueObject          $lvl,
        ProtectionValueObject   $protection
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
        $this->healthPoints = $healthPoints;
        $this->power = $power;
        $this->initiative = $initiative;
        $this->intelligence = $intelligence;
        $this->lvl = $lvl;
        $this->protection = $protection;
    }

    public function getId(): ?int
    {
        return $this?->id?->getValue();
    }

    public function getUserId(): int
    {
        return $this->userId->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getHealthPoints(): int
    {
        return $this->healthPoints->getValue();
    }

    public function getMaxHealthPoints(): int
    {
        return $this->healthPoints->getMaxHealthPoints();
    }

    public function getPower(): int
    {
        return $this->power->getValue();
    }

    public function getInitiative(): int
    {
        return $this->initiative->getValue();
    }

    public function getIntelligence(): int
    {
        return $this->intelligence->getValue();
    }

    public function getLvl(): int
    {
        return $this->lvl->getValue();
    }

    public function getProtection(): int
    {
        return $this->protection->getValue();
    }

    public function rename(NameValueObject $nameValueObject): void
    {
        $this->name = $nameValueObject;
    }

    public function setHealthPoints(HealthPointsValueObject $healthPoints): void
    {
        $this->healthPoints = $healthPoints;
    }

    public function updatePower(PowerValueObject $power): void
    {
        $this->power = $power;
    }

    public function updateInitiative(InitiativeValueObject $initiative): void
    {
        $this->initiative = $initiative;
    }

    public function updateSpeed(IntelligenceValueObject $speed): void
    {
        $this->intelligence = $speed;
    }

    public function updateLvl(LvlValueObject $lvl): void
    {
        $this->lvl = $lvl;
    }

    public function updateProtection(ProtectionValueObject $protection): void
    {
        $this->protection = $protection;
    }

    public function takeDamage(DamageValueObject $damage): int
    {
        /** @var TakeDamageEntityRuleContract $rule */
        $rule = app(TakeDamageEntityRuleContract::class);

        return $rule($this, $damage);
    }

    public function makeDamage(): DamageValueObject
    {
        /** @var MakeDamageEntityRuleContract $rule */
        $rule = app(MakeDamageEntityRuleContract::class);

        return $rule($this);
    }

    public function takeRestoreHealth(RestoreHealthValueObject $restoreHealth): int
    {
        /** @var TakeRestoreHealthRuleContract $rule */
        $rule = app(TakeRestoreHealthRuleContract::class);

        return $rule($this, $restoreHealth);
    }

    public function makeRestoreHealth(): RestoreHealthValueObject
    {
        /** @var MakeRestoreHealthRuleContract $rule */
        $rule = app(MakeRestoreHealthRuleContract::class);

        return $rule($this);
    }
}

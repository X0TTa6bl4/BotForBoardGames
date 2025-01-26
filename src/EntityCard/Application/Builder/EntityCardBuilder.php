<?php

declare(strict_types=1);

namespace src\EntityCard\Application\Builder;

use App\Models\Entity as EntityEloquentModel;
use src\EntityCard\Application\UseCase\EntityCard\Request\CreateRequest;
use src\EntityCard\Domain\Entity\EntityCard;
use src\EntityCard\Domain\Entity\ValueObject\HealthPointsValueObject;
use src\EntityCard\Domain\Entity\ValueObject\IdValueObject;
use src\EntityCard\Domain\Entity\ValueObject\InitiativeValueObject;
use src\EntityCard\Domain\Entity\ValueObject\IntelligenceValueObject;
use src\EntityCard\Domain\Entity\ValueObject\LvlValueObject;
use src\EntityCard\Domain\Entity\ValueObject\NameValueObject;
use src\EntityCard\Domain\Entity\ValueObject\PowerValueObject;
use src\EntityCard\Domain\Entity\ValueObject\ProtectionValueObject;

class EntityCardBuilder
{
    public function fromEloquentModel(EntityEloquentModel $entity): EntityCard
    {
        return new EntityCard(
            id: new IdValueObject($entity->id),
            name: new NameValueObject($entity->name),
            userId: new IdValueObject($entity->user_id),
            healthPoints: new HealthPointsValueObject($entity->health_points, $entity->health_points_max),
            power: new PowerValueObject($entity->power),
            initiative: new InitiativeValueObject($entity->initiative),
            intelligence: new IntelligenceValueObject($entity->intelligence),
            lvl: new LvlValueObject($entity->lvl),
            protection: new ProtectionValueObject($entity->protection),
        );
    }

    public function fromCreate(CreateRequest $request): EntityCard
    {
        return new EntityCard(
            id: null,
            name: new NameValueObject($request->name),
            userId: new IdValueObject($request->userId),
            healthPoints: new HealthPointsValueObject($request->healthPoints, $request->healthPoints),
            power: new PowerValueObject($request->power),
            initiative: new InitiativeValueObject($request->initiative),
            intelligence: new IntelligenceValueObject($request->intelligence),
            lvl: new LvlValueObject($request->lvl),
            protection: new ProtectionValueObject($request->protection),
        );
    }
}

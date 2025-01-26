<?php

declare(strict_types=1);

namespace src\Battle\Application\Builder;

use App\Models\Entity as EntityEloquentModel;
use src\Battle\Domain\Entity\Entity;

class EntityBuilder
{
    public function fromEloquentModel(EntityEloquentModel $entity): Entity
    {
        return new Entity(
            id: $entity->id,
            initiative: $entity->initiative,
            healthPoints: $entity->health_points
        );
    }

    public function fromCreate(array $entitiesInCombat): Entity
    {
        return new Entity(
            id: $entitiesInCombat['id'],
            initiative: $entitiesInCombat['initiative'],
            healthPoints: $entitiesInCombat['healthPoints']
        );
    }
}

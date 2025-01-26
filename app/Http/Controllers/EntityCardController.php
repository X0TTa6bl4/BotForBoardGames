<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use src\EntityCard\Application\UseCase\EntityCard\CreateUseCase;
use src\EntityCard\Application\UseCase\EntityCard\MakeDamageUseCase;
use src\EntityCard\Application\UseCase\EntityCard\Request\CreateRequest;
use src\EntityCard\Application\UseCase\EntityCard\Request\MakeDamageRequest;
use src\EntityCard\Application\UseCase\EntityCard\Request\RestoreHealthRequest;
use src\EntityCard\Application\UseCase\EntityCard\RestoreHealthUseCase;

class EntityCardController extends Controller
{
    public function create(Request $request, CreateUseCase $createUseCase): void
    {
        $createUseCase(
            new CreateRequest(
                userId: $request->input('user_id'),
                name: $request->input('name'),
                healthPoints: $request->input('health_points'),
                power: $request->input('power'),
                initiative: $request->input('initiative'),
                intelligence: $request->input('speed'),
                lvl: $request->input('lvl'),
                protection: $request->input('protection'),
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function makeDamage(Request $request, MakeDamageUseCase $makeDamageUseCase): void
    {
        $group = $makeDamageUseCase(
            new MakeDamageRequest(
                userId: $request->input('user_id'),
                entityIdThatDealsDamage: $request->input('entityIdThatDealsDamage'),
                entityIdThatTakesDamage: $request->input('entityIdThatTakesDamage')
            )
        );
    }

    public function restoreHealth(Request $request, RestoreHealthUseCase $restoreHealthUseCase)
    {
        $group = $restoreHealthUseCase(
            new RestoreHealthRequest(
                userId: $request->input('user_id'),
                entityIdThatDealsHealth: $request->input('entityIdThatDealsHealth'),
                entityIdThatTakesHealth: $request->input('entityIdThatTakesHealth')
            )
        );
    }
}

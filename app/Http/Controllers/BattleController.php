<?php

namespace App\Http\Controllers;

use App\Http\Resources\Battle\BattleResource;
use Illuminate\Http\Request;
use src\Battle\Application\UseCase\CompleteAMoveUseCase;
use src\Battle\Application\UseCase\CreateUseCase;
use src\Battle\Application\UseCase\GetByIdUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;

class BattleController extends Controller
{
    /**
     * @throws \Exception
     */
    public function create(
        Request                  $request,
        CreateUseCase            $createUseCase,
        GetGroupByOwnerIdUseCase $getGroupByOwnerIdUseCase
    ): BattleResource
    {
        $group = ($getGroupByOwnerIdUseCase)($request->input('user_id'));
        $battle = ($createUseCase)($group->getId());
        return new BattleResource($battle);
    }

    public function getById(Request $request, GetByIdUseCase $getByIdUseCase): BattleResource
    {
        return new BattleResource(($getByIdUseCase)($request->input('id')));
    }

    public function completeAMove(Request $request, CompleteAMoveUseCase $completeAMoveUseCase): BattleResource
    {
        $battle = ($completeAMoveUseCase)($request->input('id'));
        return new BattleResource($battle);
    }
}

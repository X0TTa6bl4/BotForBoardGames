<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityCard\GroupResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use src\EntityCard\Application\UseCase\Group\CreateUseCase;
use src\EntityCard\Application\UseCase\Group\GetGroupByOwnerIdUseCase;
use src\EntityCard\Application\UseCase\Group\RenameUseCase;
use src\EntityCard\Application\UseCase\Group\Request\CreateRequest;
use src\EntityCard\Application\UseCase\Group\Request\RenameRequest;

class GroupController extends Controller
{
    public function create(Request $request, CreateUseCase $createUseCase)
    {
        $user = User::query()->find($request->input('owner_id'));
        $group = $createUseCase(
            new CreateRequest(
                name: $request->input('name'),
                ownerId: $user->id
            )
        );

        return response()->json([
            'id' => $group->getId(),
            'name' => $group->getName(),
            'owner_id' => $group->getOwnerId(),
            'public_id' => $group->getPublicId(),
        ]);
    }

    public function rename(Request $request, RenameUseCase $renameUseCase): void
    {
        $renameUseCase(
            new RenameRequest(
                ownerId: $request->input('owner_id'),
                newName: $request->input('new_name')
            )
        );
    }

    public function addUser(Request $request): void
    {
        $user = User::query()->find($request->input('user_id'));
        $group = Group::query()->where('public_id', $request->input('public_id'))->first();

        //$user->group()->sync($group->id);

        $group->players()->attach($user->id);
    }

    public function getAllUsers(Request $request): array
    {
        return Group::query()
            ->select('id', 'name', 'owner_id')
            ->where('public_id', $request->input('public_id'))
            ->with([
                'owner' => function ($query) {
                    $query->select('id', 'name');
                },
                'owner.entities' => function ($query) {
                    $query->select('id', 'user_id', 'power', 'lvl', 'health_points', 'protection');
                },
                'players' => function ($query) {
                    $query->select('users.id', 'name');
                },
                'players.entities' => function ($query) {
                    $query->select('id', 'user_id', 'power', 'lvl', 'health_points', 'protection');
                },
            ])->first()->toArray();
    }

    public function getGroup(Request $request, GetGroupByOwnerIdUseCase $getGroupByOwnerIdUseCase)
    {
        $group = $getGroupByOwnerIdUseCase($request->input('owner_id'));

        return new GroupResource($group);
    }

}

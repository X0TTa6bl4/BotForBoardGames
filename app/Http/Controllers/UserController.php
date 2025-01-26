<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use src\User\Application\UseCase\CreateUseCase;
use src\User\Application\UseCase\DeletedUseCase;
use src\User\Application\UseCase\GetByIdUseCase;
use src\User\Application\UseCase\Request\CreateRequest;
use src\User\Application\UseCase\Request\UpdateRequest;
use src\User\Application\UseCase\UpdateUseCase;

class UserController extends Controller
{
    public function create(Request $request, CreateUseCase $createUseCase): JsonResponse
    {
        $user = $createUseCase(
            new CreateRequest(
                name: $request->input('name'),
            )
        );

        return response()->json([
            'id' => $user->getId(),
            'name' => $user->getName(),
        ]);
    }

    public function update(Request $request, UpdateUseCase $updateUseCase): JsonResponse
    {
        $user = $updateUseCase(
            new UpdateRequest(
                id: $request->input('id'),
                name: $request->input('name'),
            )
        );

        return response()->json([
            'id' => $user->getId(),
            'name' => $user->getName(),
        ]);
    }

    public function findById(Request $request, GetByIdUseCase $findByIdUseCase): JsonResponse
    {
        $user = $findByIdUseCase($request->input('id'));

        return response()->json([
            'id' => $user->getId(),
            'name' => $user->getName(),
        ]);
    }

    public function deleted(Request $request, DeletedUseCase $deletedUseCase): void
    {
        $deletedUseCase($request->input('id'));
    }
}

<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post('v1/test', [TestController::class, 'test']);

Route::post('v1/user/create', [\App\Http\Controllers\UserController::class, 'create']);

Route::post('v1/entity/create', [\App\Http\Controllers\EntityCardController::class, 'create']);
Route::post('v1/entity/make-damage', [\App\Http\Controllers\EntityCardController::class, 'makeDamage']);
Route::post('v1/entity/restore-health', [\App\Http\Controllers\EntityCardController::class, 'restoreHealth']);

Route::post('v1/group/create', [\App\Http\Controllers\GroupController::class, 'create']);
Route::post('v1/group/rename', [\App\Http\Controllers\GroupController::class, 'rename']);
Route::post('v1/group/add-user', [\App\Http\Controllers\GroupController::class, 'addUser']);
Route::post('v1/group/all-users', [\App\Http\Controllers\GroupController::class, 'getAllUsers']);
Route::post('v1/group/get', [\App\Http\Controllers\GroupController::class, 'getGroup']);

Route::post('v1/battle/create', [\App\Http\Controllers\BattleController::class, 'create']);
Route::post('v1/battle/get', [\App\Http\Controllers\BattleController::class, 'getById']);
Route::post('v1/battle/complete-a-move', [\App\Http\Controllers\BattleController::class, 'completeAMove']);

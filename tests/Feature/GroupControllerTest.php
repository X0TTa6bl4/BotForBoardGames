<?php

namespace Tests\Feature;

use App\Http\Controllers\GroupController;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class GroupControllerTest extends FeatureCase
{
    use RefreshDatabase;

    protected Model $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    protected function createUser(array $attributes = []): Model
    {
        return User::factory()->create($attributes);
    }

    protected function createGroup(array $attributes = []): Model
    {
        return Group::factory()->create($attributes);
    }

    #[Test]
    public function is_should_create_group(): void
    {
        $response = $this->post(
            action([GroupController::class, 'create']),
            [
                'name' => 'test',
                'owner_id' => $this->user->id,
            ],
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'name' => 'test',
            'owner_id' => $this->user->id,
        ]);
    }

    #[Test]
    public function is_should_rename_group(): void
    {
        $oldName = 'oldNameGroup';
        $this->createGroup([
            'owner_id' => $this->user->id,
            'name' => $oldName,
        ]);
        $this->assertDatabaseHas('groups', [
            'name' => $oldName,
            'owner_id' => $this->user->id,
        ]);

        $newName = 'newNameGroup';
        $response = $this->post(
            action([GroupController::class, 'rename']),
            [
                'new_name' => $newName,
                'owner_id' => $this->user->id,
            ],
        );
        $response->assertOk();

        $this->assertDatabaseHas('groups', [
            'name' => $newName,
            'owner_id' => $this->user->id,
        ]);
    }

    #[Test]
    public function is_should_added_user_to_group(): void
    {
        $group = $this->createGroup([
            'owner_id' => $this->user->id,
        ]);
        $newUser = $this->createUser();
        $response = $this->post(
            action([GroupController::class, 'addUser']),
            [
                'public_id' => $group->public_id,
                'user_id' => $newUser->id,
            ],
        );
        $response->assertOk();

        $this->assertDatabaseHas('group_user', [
            'group_id' => $group->id,
            'user_id' => $newUser->id,
        ]);
    }
}

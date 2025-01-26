<?php

namespace Tests\Feature;

use App\Http\Controllers\EntityCardController;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EntityCardControllerTest extends FeatureCase
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

    #[Test]
    public function is_should_crate_entity(): void
    {
        $response = $this->post(
            action([EntityCardController::class, 'create']),
            [
                'user_id' => $this->user->id,
                'health_points' => 100,
                'power' => 10,
                'initiative' => 10,
                'speed' => 10,
                'lvl' => 1,
                'protection' => 10,
            ],
        );

        $response->assertOk();

        $this->assertDatabaseHas('entities', [
            'user_id' => $this->user->id,
            'health_points' => 100,
            'power' => 10,
            'initiative' => 10,
            'speed' => 10,
            'lvl' => 1,
            'protection' => 10,
        ]);
    }
}

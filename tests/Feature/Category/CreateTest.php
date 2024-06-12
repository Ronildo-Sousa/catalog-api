<?php

namespace Tests\Feature\Category;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_create_a_category()
    {
        $owner = User::factory()->create();
        $payload = [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(10),
        ];

        $response = $this->actingAs($owner)
            ->postJson(route('categories.store'), $payload);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['message', 'category']);

        $this->assertDatabaseHas('categories', array_merge(
            $payload,
            ['owner_id' => $owner->id]
        ));
    }

    #[Test]
    public function title_field_and_description_should_be_required()
    {
        $owner = User::factory()->create();
        $payload = [
            'title' => '',
            'description' => '',
        ];

        $response = $this->actingAs($owner)
            ->postJson(route('categories.store'), $payload);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

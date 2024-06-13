<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_update_a_category()
    {
        $owner = User::factory()->create();
        $category = Category::factory()->create(['owner_id' => $owner->id]);
        $payload = [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(10),
        ];

        $response = $this->actingAs($owner)
            ->putJson(route('categories.update', $category), $payload);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('categories', array_merge(
            $payload,
            ['owner_id' => $owner->id]
        ));
    }
    
    #[Test]
    public function only_owners_can_update_category()
    {
        $owner1 = User::factory()->create();
        $owner2 = User::factory()->create();
        $category = Category::factory()->create(['owner_id' => $owner1->id]);
        $payload = [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(10),
        ];

        $response = $this->actingAs($owner2)
            ->putJson(route('categories.update', $category), $payload);

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('categories', $category->toArray());
    }
}

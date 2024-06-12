<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_delete_a_category()
    {
        $owner = User::factory()->create();
        $category = Category::factory()->create(['owner_id' => $owner->id]);

        $response = $this->actingAs($owner)
            ->deleteJson(route('categories.destroy', $category->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
    
    #[Test]
    public function only_owners_can_delete_a_category()
    {
        $owner1 = User::factory()->create();
        $category = Category::factory()->create(['owner_id' => $owner1->id]);
        $owner2 = User::factory()->create();

        $response = $this->actingAs($owner2)
            ->deleteJson(route('categories.destroy', $category->id));

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('categories', $category->toArray());
    }

    #[Test]
    public function it_should_return_error_when_delete_an_invalid_category()
    {
        $owner = User::factory()->create();

        $response = $this->actingAs($owner)
            ->deleteJson(route('categories.destroy', '000'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}

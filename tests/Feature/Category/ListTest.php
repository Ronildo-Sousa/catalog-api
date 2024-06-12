<?php

namespace Tests\Feature\Category;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_list_categories()
    {
        $owner = User::factory()->create();
        Category::factory()
            ->for($owner, 'owner')
            ->count(3)
            ->create();

        $response = $this->actingAs($owner)
            ->getJson(route('categories.index'));

        $response->assertStatus(Response::HTTP_OK);
    }
}

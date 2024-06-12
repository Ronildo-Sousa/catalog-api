<?php

namespace Tests\Feature\Category;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_create_a_category()
    {
        $owner = User::factory()->create();
        $category = Category::factory()
            ->for($owner, 'owner')
            ->create();

        $response = $this->getJson(route('categories.show', $category));

        $categoryDTO = CategoryDTO::from($category->toArray())->toArray();
        $response->assertStatus(Response::HTTP_OK)
            ->assertSimilarJson($categoryDTO);
    }
    
    #[Test]
    public function it_should_return_error_when_show_a_invalid_category()
    {
        $response = $this->getJson(route('categories.show', '000'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}

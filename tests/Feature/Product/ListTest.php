<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_should_be_able_to_list_products()
    {
        $owner = User::factory()->create();
        ProductFactory::createWithOwner($owner, 3);

        $response = $this->actingAs($owner)
            ->getJson(route('products.index'));

        $response->assertStatus(Response::HTTP_OK);
    }
}

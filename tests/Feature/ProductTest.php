<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * ADMIN
     */

    public function test_if_product_loaded_in_admin()
    {
        $response = $this->getJson('/api/products');
        $response->assertSuccessful();
    }
    public function test_if_product_item_loaded_in_admin()
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products/' . $product->id);
        $response->assertSuccessful();
    }
    public function test_if_product_created_in_admin()
    {
        $data = Product::factory()->make()->getAttributes();
        $response = $this->postJson('/api/products', $data);
        $response->assertSuccessful();
    }

    public function test_if_product_created_validation_in_admin()
    {
        $data = [];
        $response = $this->postJson('/api/products', $data);
        $response->assertUnprocessable();
    }

    public function test_if_product_updated_in_admin()
    {
        $product = Product::factory()->create();
        $product1 = Product::factory()->make()->getAttributes();
        $response = $this->putJson('/api/products/' . $product->id, $product1);
        $response->assertSuccessful();
    }
    public function test_if_product_deleted_in_admin()
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson('/api/products/' . $product->id);
        $response->assertSuccessful();
    }

}

<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * ADMIN
     */

    public function test_if_brand_loaded_in_admin()
    {
        $response = $this->getJson('/api/brands');
        $response->assertSuccessful();
    }
    public function test_if_brand_item_loaded_in_admin()
    {
        $brand = Brand::factory()->create();
        $response = $this->getJson('/api/brands/' . $brand->id);
        $response->assertSuccessful();
    }
    public function test_if_brand_created_in_admin()
    {
        $data = Brand::factory()->make()->getAttributes();
        $response = $this->postJson('/api/brands', $data);
        $response->assertSuccessful();
    }

    public function test_if_brand_created_validation_in_admin()
    {
        $data = [];
        $response = $this->postJson('/api/brands', $data);
        $response->assertUnprocessable();
    }

    public function test_if_brand_updated_in_admin()
    {
        $brand = Brand::factory()->create();
        $brand1 = Brand::factory()->make()->getAttributes();
        $response = $this->putJson('/api/brands/' . $brand->id, $brand1);
        $response->assertSuccessful();
    }
    public function test_if_brand_deleted_in_admin()
    {
        $brand = Brand::factory()->create();
        $response = $this->deleteJson('/api/brands/' . $brand->id);
        $response->assertSuccessful();
    }

    public function test_if_brand_deleted_validation_in_admin()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id'=>$brand->id]);
        $response = $this->deleteJson('/api/brands/' . $brand->id);
        $response->assertUnprocessable();
    }
}

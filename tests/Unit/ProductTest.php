<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
   /** @test */
   public function check_if_product_columns_is_correct()
   {
       $product = new Product();
       $expected = ['name','description','voltage', 'brand_id'];
       $actual = $product->getFillable();
       $this->assertEquals($expected, $actual);
   }
}

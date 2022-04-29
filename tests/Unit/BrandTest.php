<?php

namespace Tests\Unit;

use App\Models\Brand;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
   /** @test */
   public function check_if_brand_columns_is_correct()
   {
       $brand = new Brand();
       $expected = ['name'];
       $actual = $brand->getFillable();
       $this->assertEquals($expected, $actual);
   }
}

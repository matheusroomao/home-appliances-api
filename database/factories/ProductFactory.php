<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $voltages = ['220v','110v'];
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(20),
            'voltage' => $voltages[array_rand($voltages)],
            'brand_id' => Brand::factory()->create()->id
        ];
    }
}

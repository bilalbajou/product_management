<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */

    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100, 1000),
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->numberBetween(1, 100)
        ];
    }
}

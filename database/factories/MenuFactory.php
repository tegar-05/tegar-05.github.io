<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MenuFactory extends Factory
{
    protected $model = \App\Models\Menu::class;

    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => ucfirst($name),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 15, 120),
            'category_id' => \App\Models\Category::factory(),
            'image' => null,
            'is_popular' => $this->faker->boolean(30),
            'is_active' => true,
        ];
    }
}

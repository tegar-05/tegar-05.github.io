<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    protected $model = \App\Models\Slider::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(8),
            'link' => $this->faker->url(),
            'order' => $this->faker->numberBetween(1, 10),
            'image' => null,
            'is_active' => true,
        ];
    }
}

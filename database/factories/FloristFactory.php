<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FloristFactory extends Factory
{
    protected $model = \App\Models\Florist::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(10),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'image' => null,
            'is_active' => true,
        ];
    }
}

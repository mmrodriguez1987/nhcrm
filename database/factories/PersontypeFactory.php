<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use newhopecrm\Models\Persontype;

class PersontypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Persontype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'active' => $this->faker->boolean
        ];
    }
}
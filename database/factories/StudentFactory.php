<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->boolean(),
            'birthday' => $this->faker->dateTimeBetween('-30 years','-18 years'),
            'course_id' => Course::query()->inRandomOrder()->value('id'),

        ];
    }
}

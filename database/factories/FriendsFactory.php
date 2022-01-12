<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class FriendsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id1' => User::all()->random()->id,
            'user_id2' => User::all()->random()->id,
            'validate' => $this->faker->boolean(),
        ];
    }
}

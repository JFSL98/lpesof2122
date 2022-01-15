<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Friends;

class FriendsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::all()->random()->id;
        $friend_id = User::all()->random()->id;
        //check if user_id and friend_id are not the same
        while ($user_id == $friend_id) {
            $friend_id = User::all()->random()->id;
        }
        //check if user_id and friend_id are not already friends
        while (Friends::all()->where([['user_id', '=', $user_id], ['friend_id', '=', $friend_id]])->first()) {
            $friend_id = User::all()->random()->id;
        }
        return [
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            'validate' => $this->faker->boolean(),
        ];
    }
}

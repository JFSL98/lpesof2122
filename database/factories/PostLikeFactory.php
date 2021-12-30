<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;

class PostLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*
        $user_id = User::all()->random()->id;
        $post_id = Post::all()->random()->id;

        while (PostLike::all()->where([['user_id', '=', $user_id], ['post_id', '=', $post_id]])->first()) {
            $user_id = User::all()->random()->id;
            $post_id = Post::all()->random()->id;
        }
        */

        $user_count = User::all()->count();
        $post_count = Post::all()->count();

        $user_post = [];
        for ($i = 1; $i <= $user_count; $i++) {
            for ($j = 1; $j <= $post_count; $j++) {
                array_push($user_post, $i . "-" . $j);
            }
        }

        $user_post = $this->faker->unique->randomElement($user_post);
        
        $user_post = explode('-', $user_post);

        $user_id = $user_post[0];
        $post_id = $user_post[1];

        return [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'like_dislike' => $this->faker->boolean(),
        ];
    }
}

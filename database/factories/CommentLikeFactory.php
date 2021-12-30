<?php

namespace Database\Factories;

use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_count = User::all()->count();
        $comment_count = PostComment::all()->count();

        $user_comment = [];
        for ($i = 1; $i <= $user_count; $i++) {
            for ($j = 1; $j <= $comment_count; $j++) {
                array_push($user_comment, $i . "-" . $j);
            }
        }

        $user_comment = $this->faker->unique->randomElement($user_comment);
        
        $user_comment = explode('-', $user_comment);

        $user_id = $user_comment[0];
        $comment_id = $user_comment[1];

        return [
            'user_id' => $user_id,
            'post_comment_id' => $comment_id,
            'like_dislike' => $this->faker->boolean(),
        ];
    }
}

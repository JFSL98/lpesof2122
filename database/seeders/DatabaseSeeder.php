<?php

namespace Database\Seeders;

use App\Models\CommentLike;
use App\Models\Friends;
use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Post::factory(100)->create();
        PostComment::factory(200)->create();
        PostLike::factory(500)->create();
        CommentLike::factory(500)->create();
        Friends::factory(500)->create();
    }
}

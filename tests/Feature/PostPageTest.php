<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\PostComment;
use Faker\Provider\Lorem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostPageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    /**
     * @test
     */
    public function cant_see_post_without_authenticating()
    {
        User::factory()->create()->first();
        $post = Post::factory()->create()->first();

        $response = $this->get('/post/'.$post->id);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function see_post()
    {
        $user = User::factory()->create()->first();
        $post = Post::factory()->create()->first();

        $this->actingAs($user);

        // a post that exists
        $response = $this->get('/post/'.$post->id);
        $response->assertSeeInOrder([$user->name, $post->content, 'Comment:']);

        // a post that doesn't exist
        $response = $this->get('/post/1000');
        $response->assertSee('Este post não existe!');
    }

    /** @test */
    public function delete_post()
    {
        $user = User::factory()->create()->first();
        $post = Post::factory()->create()->first();

        $this->actingAs($user);

        $this->assertDatabaseHas('posts', ['id' => $post->id]);

        $this->post('/post/remove', ['id' => $post->id]);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function create_and_delete_a_comment()
    {
        $user = User::factory()->create()->first();
        $post = Post::factory()->create()->first();

        $this->actingAs($user);

        $response = $this->post('/post/comment/new', ['post_id' => $post->id, 'content' => 'Lorem ipsum']);

        $response->assertStatus(201);

        $this->assertDatabaseHas('post_comments', ['user_id' => $user->id, 'post_id' => $post->id]);

        $post_comment = PostComment::find(1);

        $response = $this->post('/post/comment/remove', ['id' => $post_comment->id]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('post_comments', ['id' => $post_comment->id]);
    }

    /** @test */
    public function see_list_of_comments_ordered()
    {
        $user = User::factory()->create()->first();

        $posts = Post::factory(2)->create();
        $post = $posts->find(1);
        $other_post = $posts->find(2);

        $this->actingAs($user);

        $response = $this->get('/post/'.$post->id);
        $response->assertSee('Comment:');
        $response->assertSee('No comments yet.');
        
        $date_oldest = '2020-01-15';
        $date_middle = '2021-01-01';
        $date_newest = '2022-01-16';
        $date_other_post = '2000-01-01';

        //comments
        PostComment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => $this->faker->sentence,
            'created_at' => $date_oldest,
            'updated_at' => $date_oldest
        ]);

        PostComment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => $this->faker->sentence,
            'created_at' => $date_middle,
            'updated_at' => $date_middle
        ]);

        PostComment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => $this->faker->sentence,
            'created_at' => $date_newest,
            'updated_at' => $date_newest
        ]);

        PostComment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $other_post->id,
            'content' => $this->faker->sentence,
            'created_at' => $date_other_post,
            'updated_at' => $date_other_post
        ]);

        $comment_oldest = PostComment::find(1);
        $comment_middle = PostComment::find(2);
        $comment_newest = PostComment::find(3);
        $comment_other_post = PostComment::find(4);

        $this->assertDatabaseCount('post_comments',4);

        $response = $this->get('/post/'.$post->id);
        $response->assertDontSee('No comments yet.');
        $response->assertSee($comment_newest->created_at);
        $response->assertSee($comment_oldest->created_at);
        $response->assertSeeInOrder([$comment_newest->created_at,$comment_middle->created_at,$comment_oldest->created_at]);
        $response->assertDontSee($comment_other_post->created_at);
    }

    /** @test */
    public function like_and_dislike_post_and_comment()
    {
        $user = User::factory()->create()->first();
        $post = Post::factory()->create()->first();
        $comment = PostComment::factory()->create()->first();

        $this->actingAs($user);

        // Like Post
        $this->post('/post/like', ['id' => $post->id, 'like_dislike' => true]);
        $this->assertDatabaseHas('post_likes', ['user_id' => $user->id, 'post_id' => $post->id, 'like_dislike' => true]);
        $this->assertDatabaseCount('post_likes',1);

        // Swap Like with Dislike Post
        $this->post('/post/like', ['id' => $post->id, 'like_dislike' => false]);
        $this->assertDatabaseHas('post_likes', ['user_id' => $user->id, 'post_id' => $post->id, 'like_dislike' => false]);
        $this->assertDatabaseCount('post_likes',1);

        // Remove Like/Dislike Post
        $this->post('/post/like', ['id' => $post->id, 'like_dislike' => false]);
        $this->assertDatabaseMissing('post_likes', ['user_id' => $user->id, 'post_id' => $post->id]);
        $this->assertDatabaseCount('post_likes',0);

        // Like Comment
        $this->post('/post/comment/like', ['id' => $comment->id, 'like_dislike' => true]);
        $this->assertDatabaseHas('comment_likes', ['user_id' => $user->id, 'post_comment_id' => $comment->id, 'like_dislike' => true]);
        $this->assertDatabaseCount('comment_likes',1);

        // Swap Like with Dislike Comment
        $this->post('/post/comment/like', ['id' => $comment->id, 'like_dislike' => false]);
        $this->assertDatabaseHas('comment_likes', ['user_id' => $user->id, 'post_comment_id' => $comment->id, 'like_dislike' => false]);
        $this->assertDatabaseCount('comment_likes',1);

        // Remove Like/Dislike Post
        $this->post('/post/comment/like', ['id' => $comment->id, 'like_dislike' => false]);
        $this->assertDatabaseMissing('comment_likes', ['user_id' => $user->id, 'post_comment_id' => $comment->id]);
        $this->assertDatabaseCount('comment_likes',0);
    }
}

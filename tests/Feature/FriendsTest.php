<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class FriendsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function add_friend()
    {
        $users = User::factory(2)->create();
        $user = $users->find(1);
        $user2 = $users->find(2);

        $this->actingAs($user);

        $this->post($user2->id.'/friend/new',['friend_id' => $user2->id ]);
        
        $this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>false]);
        $this->assertDatabaseCount('friends',1);

        $this->actingAs($user2);

        $this->post($user->id.'/friend/new',['friend_id' => $user->id]);

        $this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>true]);
        $this->assertDatabaseHas('friends',['user_id'=>$user2->id,'friend_id'=>$user->id,'validate'=>true]);

        $this->assertDatabaseCount('friends',2);
    }

    /** @test */
    public function remove_friend()
    {
        $users = User::factory(2)->create();
        $user = $users->find(1);
        $user2 = $users->find(2);

        $this->actingAs($user);

        $this->post($user2->id.'/friend/new',['friend_id' => $user2->id ]);
        
        $this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>false]);
        $this->assertDatabaseCount('friends',1);

        $this->actingAs($user2);

        $this->post($user->id.'/friend/new',['friend_id' => $user->id]);

        $this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>true]);
        $this->assertDatabaseHas('friends',['user_id'=>$user2->id,'friend_id'=>$user->id,'validate'=>true]);

        $this->assertDatabaseCount('friends',2);

        $this->post($user->id.'/friend/remove',['friend_id' => $user->id ]);
        $this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>false]);
        $this->assertDatabaseCount('friends',1);


        $this->actingAs($user);
        $this->post($user2->id.'/friend/remove',['friend_id' => $user2->id ]);
        $this->assertDatabaseCount('friends',0);

    }

}

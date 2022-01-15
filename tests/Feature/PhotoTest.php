<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Photo;

class PhotoTest extends TestCase
{

    use RefreshDatabase;

    
    public function change_profile_pic()
    {
        $user = User::factory()->create()->first();
        Storage::fake('image');

        $this->actingAs($user);

        
        

        $file = UploadedFile::fake()->image('image.jpg');
        

        $response = $this->post($user->id.'/upload', [
            'image' => $file,
        ]);
        $this->assertDatabaseCount('photos',1);
        Storage::disk('image')->assertExists(storage_path('app\public\images\profile_pic\\').$file->hashName());
        
    }

    /** @test */
    public function add_friend(){

        $user = User::factory()->create()->first();
        $user2 =  User::factory()->create()->first();
    

        $this->actingAs($user);

        $this->post($user2->id.'/friend/new',['friend_id' => $user2->id ]);
        //$this->assertDatabaseHas('friends',['user_id'=>$user->id,'friend_id'=>$user2->id,'validate'=>false]);

        $this->assertDatabaseCount('friends',1);        
        $this->actingAs($user2);

        $this->post($user->id.'/friend/new',['friend_id' => $user->id]);

        $this->assertDatabaseCount('friends',2);  

    }

}

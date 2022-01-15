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
}

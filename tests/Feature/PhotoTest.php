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

    /** @test */
    public function change_profile_pic()
    {
        $user = User::factory()->create()->first();
        
        Storage::fake('images');
        config()->set('filesystems.disks.images', [
            'driver' => 'local',
            'root' => Storage::disk('images')->getAdapter()->getPathPrefix(),
        ]);

        $this->actingAs($user);

        $image1 = 'image.jpg';

        $file = UploadedFile::fake()->image($image1);

        $firstHashName = $file->hashName();
        
        $this->post($user->id.'/upload', [
            'image' => $file,
        ]);

        $this->assertDatabaseCount('photos',1);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'profile_pic_id' => 1]);
        $this->assertDatabaseHas('photos', ['user_id' => $user->id, 'name' => $image1, 'path' => $firstHashName]);
        $this->assertFileExists(storage_path('app/public/images/profile_pic/'.$firstHashName));

        // change profile picture
        $image2 = 'image2.jpg';

        $file = UploadedFile::fake()->image($image2);

        $secondHashName = $file->hashName();
        
        $this->post($user->id.'/upload', [
            'image' => $file,
        ]);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'profile_pic_id' => 2]);
        $this->assertDatabaseHas('photos', ['user_id' => $user->id, 'name' => $image2, 'path' => $secondHashName]);
        $this->assertDeleted('photos', ['user_id' => $user->id, 'name' => $image2, 'path' => $firstHashName]);
        $this->assertFileExists(storage_path('app/public/images/profile_pic/'.$secondHashName));
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_see_login_register_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeInOrder(['Login','Registar']);
    }

    /**
     * @test
     */
    public function can_see_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeInOrder(['E-Mail Address','Password','Remember Me', 'Forgot Your Password?']);

    }

    /**
     * @test
     */
    public function can_see_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSeeInOrder(['Name','E-Mail Address','Password']);

    }

    /**
     * @test
     */
    public function redirect_from_auth_page_to_home_as_authenticaded_user()
    {
        $user = User::create([
            'name' => 'Joao Lopes',
            'email' => 'joao@mail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(302);

        $response->assertRedirect('/home');
    }
}

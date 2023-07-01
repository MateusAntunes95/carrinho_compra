<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_redirects_to_home_if_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('login.index'));

        $response->assertRedirect(route('home'));
    }

    public function test_index_displays_login_form_if_not_authenticated()
    {
        $response = $this->get(route('login.index'));

        $response->assertViewIs('login.index');
    }

    public function test_store_redirects_to_home_on_successful_authentication()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_store_redirects_to_login_with_error_on_failed_authentication()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'invalid@example.com',
            'password' => 'invalid_password',
        ]);

        $response->assertRedirect(route('login.index'))
            ->assertSessionHasErrors(['error' => 'Email ou Password errado']);
    }
}

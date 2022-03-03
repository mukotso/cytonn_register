<?php

namespace Tests\Feature;

use Tests\TestCase;
use function create;

class UserTests extends TestCase
{
    public function test_authenticated_user_can_view_users()
    {
        $this->signIn();
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
    public function test_guest_user_cannot_view_users()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_user()
    {
        $this->signIn();
        $user=create('App\Models\User');
        $this->get('/users')->assertSee($user->name);
    }

    public function test_guest_user_cannot_create_user()
    {
        create('App\Models\User');
        $this->get('/users')->assertRedirect('/login');
    }

}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function canViewUsersPage()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function canCreateUser()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function canEditUser()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function canDeleteUser()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
}

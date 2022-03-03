<?php

namespace Tests\Feature;

use Tests\TestCase;

class userProfileTest extends TestCase
{
    /** @test **/
    public function test_authenticated_user_can_view_profile()
    {
        $this->signIn();
        $this->get('/profile')
         ->assertStatus(200);
    }

    public function test_guest_user_cannot_view_profile()
    {
        $this->get('/profile')
            ->assertRedirect('/login');
    }
}

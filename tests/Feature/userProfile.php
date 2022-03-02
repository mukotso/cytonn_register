<?php

namespace Tests\Feature;

use Tests\TestCase;

class userProfile extends TestCase
{
    public function test_user_can_view_profile()
    {
        $user=$this->signIn();
        $this->get('/profiles')
         ->assertSee($user->first_name);
    }
}

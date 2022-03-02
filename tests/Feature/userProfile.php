<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class userProfile extends TestCase
{
    public function userCanViewProfile()
    {
        $this->signIn();
        $user = create('App\Models\User');

        $this->get('/profiles)
            ->assertSee($user->first_name);
    }
}

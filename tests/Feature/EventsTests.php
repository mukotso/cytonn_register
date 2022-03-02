<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventsTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function userCanViewEventsPage()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }

    public function userCanAddEvent()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }

    public function userViewEventsDetails()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }

    public function userEditEventsDetails()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }
    public function userDeleteEvent()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }
    public function EventHasActivities()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }
    public function eventHasTeamMembers()
    {
        $response = $this->get('/events');

        $response->assertStatus(200);
    }
}

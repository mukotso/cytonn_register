<?php
namespace Tests\Unit;
use Tests\TestCase;
class EventsTests extends TestCase
{
    public function test_guest_user_cannot_view_events_page()
    {
        $response = $this->get('/events');
        $response->assertRedirect('/login');
    }
    public function test_authenticated_user_can_view_events_page()
    {
        $this->signIn();
        $response = $this->get('/events');
        $response->assertSuccessful();
        $response->assertViewIs('events.index');
    }
    public function test_authenticated_user_can_create_event()
    {
        $this->signIn();
        $event=create('App\Models\Event');
        $this->get('/events')->assertSee($event->name);
    }
    public function test_guest_user_cannot_create_event()
    {
        create('App\Models\Event');
        $this->get('/events')
            ->assertRedirect('/login');
    }
}

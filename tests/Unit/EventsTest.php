<?php
namespace Tests\Unit;
use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
class EventsTests extends TestCase
{
    public function test_guest_user_cannot_view_events_page()
    {
        $response = $this->get('/events');
        $response->assertRedirect('/login');
    }

    public function test_event_has_an_owner()
    {
        $event = create('App\Models\Event');
        $this->assertInstanceOf(User::class, $event->creator);

    }
    public function test_event_has_a_category()
    {
        $event = create('App\Models\Event');
        $this->assertInstanceOf(Category::class, $event->category);

    }
    public function test_authenticated_user_can_view_events_page()
    {
        $this->signIn();
        $response = $this->get('/events');
        $response->assertSuccessful();
        $response->assertViewIs('events.index');
    }

    public function test_guest_user_cannot_create_event()
    {
        create('App\Models\Event');
        $this->get('/events')
            ->assertRedirect('/login');
    }
}

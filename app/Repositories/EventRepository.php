<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Activity;
use App\Models\Event;
use App\Models\EventTeamMember;

class EventRepository implements EventRepositoryInterface
{
    public function createEvent(array $eventDetails)
    {

            Event::create($eventDetails);
            Activity::create($eventDetails);
          return   EventTeamMember::create($eventDetails);
    }
    public function getAllEvents()
    {
        return Event::orderBy('created_at', 'DESC')->get();
    }
    public function updateEvent($event, $newDetails)
    {
        return $event->update($newDetails);
    }
    public function deleteEvent($EventId)
    {
        return Event::destroy($EventId);
    }

}



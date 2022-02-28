<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Activity;
use App\Models\DepartmentEvent;
use App\Models\Event;
use App\Models\EventTeamMember;

class EventRepository implements EventRepositoryInterface
{
    public function createEvent(array $eventDetails)
    {
//       dd($eventDetails['teamMembers']);
//
        $event=new Event();
        $event->category_id=$eventDetails['category_id'];
        $event->frequency_id=$eventDetails['frequency_id'];
        $event->name=$eventDetails['name'];
        $event->venue=$eventDetails['venue'];
        $event->start_date=$eventDetails['event_date'];
        $event->event_date=$eventDetails['event_date'];
        $event->lead_time=$eventDetails['lead_date'];
        $event->save();

        //activity
       foreach($eventDetails['activities'] as $activityDescription){
        $activity=new Activity();
        $activity->event_id=$event->id;
        $activity->description=$activityDescription;
        $activity->status='active';
        $activity->save();
    }

//        team member
        foreach($eventDetails['teamMembers'] as $teamMember){
            $eventTeamMember= new EventTeamMember;
            $eventTeamMember->event_id=$event->id;
            $eventTeamMember->user_id=$teamMember['user']['id'];
            $eventTeamMember->is_owner=0;
            $eventTeamMember->designation=$teamMember['designation'];
            $eventTeamMember->save();
        }



        $departmentEvent=new DepartmentEvent();
        $departmentEvent->event_id=$event->id;
        $departmentEvent->department_id=$eventDetails['department_id'];
        $departmentEvent->save();
    }
    public function getAllEvents()
    {
        return Event::with('activities','teamMembers.user')->orderBy('created_at', 'DESC')->get();
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



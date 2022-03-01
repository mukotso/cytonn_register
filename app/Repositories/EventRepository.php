<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Activity;
use App\Models\DepartmentEvent;
use App\Models\Event;
use App\Models\EventTeamMember;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventRepository implements EventRepositoryInterface
{
    public function createEvent(array $eventDetails)
    {
//       dd($eventDetails['teamMembers']);
        try {
            $event = new Event();
            $event->category_id = $eventDetails['category_id'];
            $event->frequency_id = $eventDetails['frequency_id'];
            $event->name = $eventDetails['name'];
            $event->venue = $eventDetails['venue'];
            $event->start_date = $eventDetails['event_date'];
            $event->event_date = $eventDetails['event_date'];
            $event->lead_time = $eventDetails['lead_date'];
            $event->save();

            //activity

            foreach ($eventDetails['activities'] as $activityDescription) {
                $activity = new Activity();
                $activity->event_id = $event->id;
                $activity->description = $activityDescription['description'];
                $activity->status = 'active';
                $activity->save();
            }

            //create owner

            $eventTeamMember = new EventTeamMember;
            $eventTeamMember->event_id = $event->id;
            $eventTeamMember->user_id = Auth::user()->id;
            $eventTeamMember->is_owner = 1;
            $eventTeamMember->designation = 'owner';
            $eventTeamMember->save();

//        team member
            foreach ($eventDetails['teamMembers'] as $teamMember) {
                $eventTeamMember = new EventTeamMember;
                $eventTeamMember->event_id = $event->id;
                $eventTeamMember->user_id = $teamMember['user']['id'];
                $eventTeamMember->is_owner = 0;
                $eventTeamMember->designation = $teamMember['designation'];
                $eventTeamMember->save();
            }


            $departmentEvent = new DepartmentEvent();
            $departmentEvent->event_id = $event->id;
            $departmentEvent->department_id = $eventDetails['department_id'];
            $departmentEvent->save();

        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occured Task completion failed');;
        }
    }

    public function getAllEvents()
    {
        return Event::with('activities', 'teamMembers.user', 'category', 'frequency')->orderBy('created_at', 'DESC')->get();
    }

    public function getEventById($event)
    {

        return Event::where('id', $event)
            ->with('activities', 'teamMembers.user', 'category', 'frequency')
            ->get();

    }

    public function updateEvent($eventId, $eventDetails)
    {
        $event = Event::where('id', $eventId)->first();
        $event->category_id = $eventDetails['category_id'];
        $event->frequency_id = $eventDetails['frequency_id'];
        $event->name = $eventDetails['name'];
        $event->venue = $eventDetails['venue'];
        $event->start_date = $eventDetails['event_date'];
        $event->event_date = $eventDetails['event_date'];
        $event->lead_time = $eventDetails['lead_time'];
        $event->update();

        //activity
        $eventActivities = Activity::where('event_id', $eventId)->get()->toArray();
        $eventActivitiesArray = [];
        foreach ($eventActivities as $activity) {
            array_push($eventActivitiesArray, $activity['description']);
        }

        foreach ($eventDetails['activities'] as $activityDescription) {
            if (in_array($activityDescription['description'], $eventActivitiesArray)) {
                continue;
            } else {
                $activity = new Activity();
                $activity->event_id = $eventId;
                $activity->description = $activityDescription['description'];
                $activity->status = 'active';
                $activity->save();
            }
        }

//        team member
        $eventTeamMembers = EventTeamMember::where('event_id', $eventId)->get()->toArray();
        $eventTeamMembersUserIds = [];
        foreach ($eventTeamMembers as $teamMember) {
            array_push($eventTeamMembersUserIds, $teamMember['user_id']);
        }

        foreach ($eventDetails['teamMembers'] as $teamMember) {
            if (in_array($teamMember['user']['id'], $eventTeamMembersUserIds)) {
                continue;
            } else {
                $eventTeamMember = new EventTeamMember;
                $eventTeamMember->event_id = $eventId;
                $eventTeamMember->user_id = $teamMember['user']['id'];
                $eventTeamMember->is_owner = 0;
                $eventTeamMember->designation = $teamMember['designation'];
                $eventTeamMember->save();
            }
        }


//        $departmentEvent =DepartmentEvent::find();
//        $departmentEvent->event_id = $event->id;
//        $departmentEvent->department_id = $eventDetails['department_id'];
//        $departmentEvent->save();
    }

    public function deleteEvent($EventId)
    {
        return Event::destroy($EventId);
    }

}



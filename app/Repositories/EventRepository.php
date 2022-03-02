<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Activity;
use App\Models\Department;
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
            $event->user_id = Auth::user()->id;
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



//        team member
            foreach ($eventDetails['teamMembers'] as $teamMember) {
                $eventTeamMember = new EventTeamMember;
                $eventTeamMember->event_id = $event->id;
                $eventTeamMember->user_id = $teamMember['user']['id'];
                $eventTeamMember->designation = $teamMember['designation'];
                $eventTeamMember->save();
            }

            foreach ($eventDetails['departmentIds'] as $departmentId) {
                $departmentEvent = new DepartmentEvent();
                $departmentEvent->event_id = $event->id;
                $departmentEvent->department_id = $departmentId;
                $departmentEvent->save();
            }
            return response()->json(['message' => "Event Created successfully"], 200);

        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'errors' => json_decode('{ "error": "An error occurred Please Try again" }'),
            ], 400);
             }
    }

    public function getAllEvents()
    {
        $departmentId = Auth::user()->department_id;
        if (Auth()->user()->is_admin == 1) {
            return Event::whereHas('department')
                ->with('department', 'teamMembers.user')->orderBy('created_at', 'DESC')->get();

        } else {
            return Event::whereHas('department', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })->with('teamMembers.user')->orderBy('created_at', 'DESC')->get();
        }
    }


    public function getEventById($event)
    {
        return Event::where('id', $event)
            ->with('activities','creator', 'teamMembers.user', 'category', 'frequency')
            ->get();
    }

    public function updateEvent($eventId, $eventDetails)
    {
        $teamMembersUserIds = $this->getEventTeamMembers($eventId);
        $user = Auth::user();
        if (in_array($user->id, $teamMembersUserIds) || $user->is_admin == 1) {
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
            return response()->json(['message' => "Event Details Updated successfully"], 200);

        } else {
                abort(401);
        }


//        $departmentEvent =DepartmentEvent::find();
//        $departmentEvent->event_id = $event->id;
//        $departmentEvent->department_id = $eventDetails['department_id'];
//        $departmentEvent->save();
    }

    public function deleteEvent($eventId)
    {
        $teamMembersUserIds = $this->getEventTeamMembers($eventId);
        $user = Auth::user();
        if (in_array($user->id, $teamMembersUserIds) || $user->is_admin == 1) {
             Event::destroy($eventId);
            return response()->json(['message' => "Event Deleted successfully"], 200);
        } else {
            abort(401);
        }

    }

    public function getEventTeamMembers($eventId)
    {
        $members = Event::where('id', $eventId)->with('teamMembers.user')->first();
        $teamMembersUserIds = [];
        foreach ($members->teamMembers as $member) {
            array_push($teamMembersUserIds, $member->user->id);
        }
        return $teamMembersUserIds;
    }

}



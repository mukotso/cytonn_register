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
        if ($eventDetails['lead_date'] >= $eventDetails['event_date']) {
            return response()->json([
                'errors' => json_decode('{ "error": "Preparation start Date can not be more than the actual Event Date" }'),
            ], 400);
        }
        try {
            $eventDetails['user_id'] = Auth()->User()->id;
            $eventDetails['start_date'] = $eventDetails['event_date'];
            $event = Event::create($eventDetails);
            foreach ($eventDetails['activities'] as $activity) {
                $activity['event_id'] = $event->id;
                Activity::create($activity);
            }
            foreach ($eventDetails['teamMembers'] as $teamMember) {
                $teamMember['event_id'] = $event->id;
                $teamMember['user_id'] = $teamMember['user']['id'];
                EventTeamMember::create($teamMember);
            }
            foreach ($eventDetails['departmentIds'] as $department_id) {
                $department['event_id'] = $event->id;
                $department['department_id'] = $department_id;
                DepartmentEvent::create($department);
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
            ->with('activities', 'creator', 'teamMembers.user', 'category', 'frequency')
            ->get();
    }

    public function updateEvent($eventId, $eventDetails)
    {
        $teamMembersUserIds = $this->getEventTeamMembers($eventId);
        $user = Auth::user();
        if (in_array($user->id, $teamMembersUserIds) || $user->is_admin == 1) {
            $event = Event::where('id', $eventId)->first();
            $event->update($eventDetails);
            //activity
            foreach ($eventDetails['activities'] as $activity) {
                $activity['event_id'] = $event->id;
                Activity::updateOrCreate(['description' => $activity['description']], $activity);
            }
            foreach ($eventDetails['teamMembers'] as $teamMember) {
                $teamMember['event_id'] = $event->id;
                $teamMember['user_id'] = $teamMember['user']['id'];
                EventTeamMember::updateOrCreate(['user_id' => $teamMember['user_id']], $teamMember);
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

    public
    function deleteEvent($eventId)
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

    public
    function getEventTeamMembers($eventId)
    {
        $members = Event::where('id', $eventId)->with('teamMembers.user')->first();
        $teamMembersUserIds = [];
        foreach ($members->teamMembers as $member) {
            array_push($teamMembersUserIds, $member->user->id);
        }
        return $teamMembersUserIds;
    }

}



<?php

namespace App\Repositories;
use App\Interfaces\EventActivityRepositoryInterface;
use App\Models\Activity;

class EventActivityRepository implements EventActivityRepositoryInterface
{
    public function deleteActivity($activity)
    {
        Activity::destroy($activity);
        return response()->json(['message' => "Activity Deleted successfully"], 200);
    }
    public function completeActivity($activity)
    {
         Activity::where('id',$activity)
            ->update(['status'=>'completed']);
        return response()->json(['message' => "Activity Completed successfully"], 200);

    }
    public function activityNotHappening($activity)
    {
         Activity::where('id',$activity)
            ->update(['status'=>'inactive']);
        return response()->json(['message' => "Activity Cancelled successfully"], 200);
    }
}


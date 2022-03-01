<?php

namespace App\Repositories;
use App\Interfaces\EventActivityRepositoryInterface;
use App\Models\Activity;

class EventActivityRepository implements EventActivityRepositoryInterface
{
    public function deleteActivity($activity)
    {
        return Activity::destroy($activity);
    }
    public function completeActivity($activity)
    {
        return Activity::where('id',$activity)
            ->update(['status'=>'completed']);
    }
    public function activityNotHappening($activity)
    {
        return Activity::where('id',$activity)
            ->update(['status'=>'inactive']);
    }
}


<?php

namespace App\Http\Controllers;

use App\Interfaces\EventActivityRepositoryInterface;

class EventActivitiesController extends Controller
{
    public $eventActivityRepository;

    public function __construct(EventActivityRepositoryInterface $eventActivityRepository)
    {
        $this->eventActivityRepository = $eventActivityRepository;
    }

    public function destroy($activity)
    {
        $this->eventActivityRepository->deleteActivity($activity);
        return response()->json(200);

    }

    public function complete($activity)
    {
        $this->eventActivityRepository->completeActivity($activity);
        return response()->json('',200);
    }

    public function activityNotHappening($activity)
    {
        $this->eventActivityRepository->activityNotHappening($activity);
        return response()->json('',200);
    }
}


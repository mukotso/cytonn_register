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
        return $this->eventActivityRepository->deleteActivity($activity);
    }

    public function complete($activity)
    {
        return $this->eventActivityRepository->completeActivity($activity);
    }

    public function activityNotHappening($activity)
    {
        return $this->eventActivityRepository->activityNotHappening($activity);
    }
}


<?php

namespace App\Http\Controllers;

use App\Interfaces\EventTeamMemberRepositoryInterface;
use App\Models\EventTeamMember;

class ActivitiesController extends Controller
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
}

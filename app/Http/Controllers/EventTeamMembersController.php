<?php

namespace App\Http\Controllers;

use App\Interfaces\EventTeamMemberRepositoryInterface;
use App\Models\EventTeamMember;

class EventTeamMembersController extends Controller
{
    public $eventTeamMemberRepository;

    public function __construct(EventTeamMemberRepositoryInterface $eventTeamMemberRepository)
    {
        $this->eventTeamMemberRepository = $eventTeamMemberRepository;
    }

    public function destroy($teamMember)
    {

        $this->eventTeamMemberRepository->deleteMember($teamMember);
            return response()->json(200);

    }
}

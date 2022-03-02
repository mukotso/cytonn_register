<?php

namespace App\Repositories;
use App\Interfaces\EventTeamMemberRepositoryInterface;
use App\Models\EventTeamMember;

class EventTeamMemberRepository implements EventTeamMemberRepositoryInterface
{
    public function deleteMember($teamMember)
    {
         EventTeamMember::destroy($teamMember);
        return response()->json(['message' => "Member Removed successfully"], 200);
    }

}
